package com.example.myapplication;

import android.icu.text.SimpleDateFormat;
import android.os.Build;
import android.os.Bundle;
import android.support.design.widget.NavigationView;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.Button;
import android.widget.CalendarView;
import android.widget.EditText;

import java.util.Date;

public class MeetingActivity extends Navigation {

    private CalendarView calendar;
    private EditText timeCal;
    private Button MeetingButton ;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_meeting);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        toolbar.setTitle(getResources().getString(R.string.time_name));
        setSupportActionBar(toolbar);
        DrawerLayout drawer = (DrawerLayout) findViewById(R.id.drawer_layout);
        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(
                this, drawer, toolbar, R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();
        NavigationView navigationView = (NavigationView) findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        calendar = (CalendarView) findViewById(R.id.calendarView);
        timeCal = (EditText) findViewById(R.id.dayTime);
        MeetingButton = (Button) findViewById(R.id.MeetingButton);


        MeetingButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                getDates();
                sendDates();
            }
        });
    }
        public void getDates() {
            /*DateFormat pick the dates*/
            String time = null;
            String date = null;
            SimpleDateFormat sdf = null;
            time = timeCal.getText().toString();
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
                sdf = new SimpleDateFormat("dd/MM/yyyy");
            }
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.N) {
                date = sdf.format(new Date(calendar.getDate()));
            }
        }
            private void sendDates() {

            }

}
