package com.awasicovid_19.config

import android.content.Context
import java.net.URL

class ApiReq {
    val TAG = ApiReq::class.java.simpleName
    var context: Context? = null

    fun doRequest(url: String): String{
        return URL(url).readText()
    }
}