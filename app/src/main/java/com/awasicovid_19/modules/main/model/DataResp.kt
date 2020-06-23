package com.awasicovid_19.modules.main.model

import com.google.gson.annotations.Expose
import com.google.gson.annotations.SerializedName



class DataResp {
    @SerializedName("wl_id")
    @Expose
    var wlId: String? = null
    @SerializedName("wl_nama")
    @Expose
    var wlNama: String? = null
    @SerializedName("wl_terjangkit")
    @Expose
    var wlTerjangkit: String? = null
    @SerializedName("wl_suspect")
    @Expose
    var wlSuspect: String? = null
    @SerializedName("wl_cured")
    @Expose
    var wlCured: String? = null
    @SerializedName("wl_dead")
    @Expose
    var wlDead: String? = null
    @SerializedName("wl_updated")
    @Expose
    var wlUpdated: String? = null
    @SerializedName("wl_updatetime")
    @Expose
    var wlUpdatetime: String? = null
}