package com.awasicovid_19.modules.main.presenter

import com.awasicovid_19.config.ApiDB
import com.awasicovid_19.config.ApiReq
import com.awasicovid_19.modules.BaseInterface
import com.awasicovid_19.modules.main.model.DataResp
import com.google.gson.Gson
import org.jetbrains.anko.doAsync
import org.jetbrains.anko.uiThread

class MainP (private val view: BaseInterface.MainInterface,
             private val apiRepository: ApiReq,
             private val gson: Gson
) {

    fun getLatest() {
        view.showLoading()
        doAsync {
            val data = gson.fromJson(
                apiRepository
                    .doRequest(ApiDB.getLatest()),
                DataResp::class.java
            )

            uiThread {
                view.hideLoading()
                view.showData(data)
            }
        }
    }
}