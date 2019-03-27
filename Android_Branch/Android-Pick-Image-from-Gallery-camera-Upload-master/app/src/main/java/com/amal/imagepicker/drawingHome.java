package com.amal.imagepicker;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.View.OnCreateContextMenuListener;
import android.widget.Button;

public class drawingHome extends AppCompatActivity implements OnCreateContextMenuListener {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_drawing_home);

        Button upload = (Button) findViewById(R.id.upload);
        Button draw = (Button) findViewById(R.id.drawing);

       // upload.setOnClickListener(this);

    }


}
