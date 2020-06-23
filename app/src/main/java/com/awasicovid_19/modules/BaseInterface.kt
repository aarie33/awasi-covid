package com.awasicovid_19.modules

import com.awasicovid_19.modules.main.model.DataResp

interface BaseInterface {
    interface MainInterface{
        fun showLoading()
        fun hideLoading()
        fun showData(data: DataResp)
    }
}