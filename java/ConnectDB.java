package c.tests.Team11;


import android.os.StrictMode;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;


public class ConnectDB {

    private static final String dbConnString = "jdbc:mysql://phpmyadmin.in.cs.ucy.ac.cy/emirapottery?" + "user=emirapottery&password=s94mz5SN3Xu5Hafu";
    public static Connection conn = null;


    public Connection establishConnection() {

        System.out.println("Connecting database...");
        try {
            StrictMode.ThreadPolicy policy=new StrictMode.ThreadPolicy.Builder().permitAll().build();
            StrictMode.setThreadPolicy(policy);
            Class.forName("com.mysql.jdbc.Driver");
        } catch (Exception e) {
            System.out.println("Class forname error: " +e.getMessage());
        }
        try {

            if (conn == null)
                conn = DriverManager.getConnection(dbConnString);

            else if (conn.isClosed())
                conn = DriverManager.getConnection(dbConnString);

            System.out.println("Database connected!");
        } catch (SQLException e) {
            System.out.println(e.getMessage()+" "+e.getSQLState()+" "+e.getErrorCode());
        }
        return conn;
    }

}