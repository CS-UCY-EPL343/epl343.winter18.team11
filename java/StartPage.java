package c.tests.winter2018;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;

public class StartPage extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.start_page);
        new Handler().postDelayed(new Runnable() {
            public void run() {
                startActivity(new Intent(StartPage.this, MainActivity.class));

            }
        }, 2 * 1000);




    }

}
