package com.awasicovid_19.config

import android.net.Uri
import com.awasicovid_19.BuildConfig

object ApiDB {
    fun getLatest(): String{
        return Uri.parse(BuildConfig.API_URL).buildUpon()
            .appendPath("latest")
            .build()
            .toString()
    }
}