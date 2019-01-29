package com.example.myapplication;

import android.app.Application;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.toolbox.Volley;

/*Extends application -> first class before any activity */
public class StartController extends Application {

    private static StartController mInstance ;
    private RequestQueue mRequestQueue;
    public static final String TAG = "StartController";

    public static StartController getmInstance() {
        return mInstance;
    }

    public static void setmInstance(StartController mInstance) {
        StartController.mInstance = mInstance;
    }

    public RequestQueue createRequestQueue() {
        if (mRequestQueue == null) {
            mRequestQueue = Volley.newRequestQueue(getApplicationContext());
        }
        return mRequestQueue;
    }

    public <String> void addToRequestQueue(Request<String> req) {
        req.setTag(TAG);
        createRequestQueue().add(req);
    }

    protected void onStop () {
        if (mRequestQueue != null) {
            mRequestQueue.cancelAll(TAG);
        }
    }
    @Override
    public void onCreate() {
        super.onCreate();
        mInstance = this;
    }
}
