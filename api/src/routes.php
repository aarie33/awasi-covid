<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;
date_default_timezone_set('Asia/Jakarta');

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/check', function (Request $request, Response $response, array $args) use ($container) {
        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, "https://lab.isaaclin.cn/nCoV/api/area?latest=1");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $output = curl_exec($ch); 
        curl_close($ch);      
        $data = json_decode($output, TRUE);
        // array_search('green', $data)
        $indo = array();
        foreach($data['results'] as $r){
            if($r['countryEnglishName']=='Indonesia'){
                print_r($r);
                $indo = $r;
            }
        }
        $sql = "SELECT * FROM covid_wilayah WHERE wl_nama = 'Indonesia'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        if ($indo['confirmedCount']>0){
            if($result['wl_terjangkit']<>$indo['confirmedCount'] || $result['wl_suspect']<>$indo['suspectedCount'] ||
                $result['wl_cured']<>$indo['curedCount'] || $result['wl_dead']<>$indo['deadCount']){
                $id = $result["wl_id"];
                $fields = [
                    ":wl_id" => $id,
                    ":wl_terjangkit" => $indo['confirmedCount'],
                    ":wl_suspect" => $indo['suspectedCount'],
                    ":wl_cured" => $indo['curedCount'],
                    ":wl_dead" => $indo['deadCount'],
                    ":wl_updatetime" => $indo['updateTime'],
                    ":wl_updated" => date('Y-m-d H:i:s')
                ];
                $sql_upd = "UPDATE covid_wilayah SET 
                            wl_terjangkit=:wl_terjangkit, 
                            wl_suspect=:wl_suspect,
                            wl_cured=:wl_cured, 
                            wl_dead=:wl_dead, 
                            wl_updatetime=:wl_updatetime, 
                            wl_updated=:wl_updated 
                            WHERE wl_id=:wl_id";
                            
                $stmt = $this->db->prepare($sql_upd);
                $stmt->execute($fields);
                
                // notif
                $json_data = array(
                    "to"=>"/topics/usercovid",
                    "notification"=> array(
                        "sound"=>"default",
                        "icon"=>"https://m.ayobandung.com/images-bandung/post/articles/2020/03/14/82604/corona-4910057_1280.jpg",
                        "body"=> 'Terjangkit:'.$indo['confirmedCount'].
                                '-- Suspect:'.$indo['suspectedCount'].
                                '-- Sembuh:'.$indo['curedCount'].
                                '-- Meninggal:'.$indo['deadCount'],
                        "title"=> 'Update Covid-19 Indonesia'
                    ),
                    "priority"=>"high"
                );
                $data = json_encode($json_data);
            
                $url = 'https://fcm.googleapis.com/fcm/send';
                $server_key = 'AAAAPiVhGrw:APA91bEFXGCSCK6_rRMls5iOvh7jtJEy4UL1UXqoi9CJaImv9pw4l5KtjSLyZhB9Aw6e2dckuZm7H2_Rt12nTW0cLJKtsiTMFcHlw8hhLqA7jcIzZgnlnOjJYdwj9_UvnI70J_hT6y9n';
                $headers = array(
                    'Content-Type:application/json',
                    'Authorization:key='.$server_key
                );
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                $result = curl_exec($ch);
                if ($result === FALSE) {
                    die('Oops! FCM Send Error: ' . curl_error($ch));
                }
                curl_close($ch);
            }
        }
    });
    $app->get('/latest', function (Request $request, Response $response, array $args) use ($container) {
        $sql = "SELECT * FROM covid_wilayah WHERE wl_nama = 'Indonesia'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch();
        $result['wl_updated'] = date('d-m-Y H:i', strtotime($result['wl_updated']));
        echo json_encode($result);
    });
};
