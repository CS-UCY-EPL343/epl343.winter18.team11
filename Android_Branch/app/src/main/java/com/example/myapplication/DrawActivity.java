package com.example.myapplication;

import android.content.Intent;
import android.os.Bundle;

/**
 * Opening the drawing activity for the user to draw
 */
public class DrawActivity extends Navigation {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_draw);
        PaintView paintView = new PaintView(this);
        setContentView(paintView);
    }
    /*On back pressed */
    @Override
    public void onBackPressed() {
        Intent i = new Intent(getApplicationContext(), AccountActivity.class);
        startActivity(i);
        i.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        finish();
    }

}
