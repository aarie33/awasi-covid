package com.awasicovid_19.modules.main

import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import com.awasicovid_19.R
import com.awasicovid_19.config.ApiReq
import com.awasicovid_19.modules.BaseInterface
import com.awasicovid_19.modules.main.model.DataResp
import com.awasicovid_19.modules.main.presenter.MainP
import com.google.firebase.messaging.FirebaseMessaging
import com.google.gson.Gson
import kotlinx.android.synthetic.main.activity_main.*

class MainActivity : AppCompatActivity(), BaseInterface.MainInterface {
    private lateinit var presenter: MainP

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        FirebaseMessaging.getInstance().subscribeToTopic("usercovid")
            .addOnCompleteListener { task ->

            }

        val request = ApiReq()
        val gson = Gson()
        presenter = MainP(this, request, gson)
        presenter.getLatest()
    }

    override fun showLoading() {
        Toast.makeText(applicationContext, "Mohon menungu",
            Toast.LENGTH_SHORT).show()
    }

    override fun hideLoading() {
        Toast.makeText(applicationContext, "Done",
            Toast.LENGTH_SHORT).show()
    }

    override fun showData(data: DataResp) {
        txt_terjangkit.text = data.wlTerjangkit
        txt_meninggal.text = data.wlDead
        txt_sembuh.text = data.wlCured
        txt_suspect.text = data.wlSuspect
        txt_update.text = data.wlUpdated
    }
}
