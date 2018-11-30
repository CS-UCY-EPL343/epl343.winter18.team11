package c.tests.Team11;

import android.content.Intent;
import android.os.Bundle;
import android.os.Handler;
import android.support.v7.app.AppCompatActivity;

/** This is the first page that will appear to the user
 * when he will open the application.
 */

public class StartPage extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(c.tests.Team11.R.layout.start_page);
        new Handler().postDelayed(new Runnable() {
            public void run() {
                startActivity(new Intent(StartPage.this, MainActivity.class));

            }
        }, 2 * 1000);




    }

}
