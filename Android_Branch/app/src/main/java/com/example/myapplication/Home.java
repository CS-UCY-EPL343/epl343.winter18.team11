package com.example.myapplication;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;

public class Home extends AppCompatActivity {
    private static final String LOG_TAG =
            Home.class.getSimpleName();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_home);
    }

    public void launchSecondActivity(View view) {
        Intent intent = new Intent(this, LoginActivity.class);
        Log.d(LOG_TAG, "Button clicked!");
        startActivity(intent);
    }
}
