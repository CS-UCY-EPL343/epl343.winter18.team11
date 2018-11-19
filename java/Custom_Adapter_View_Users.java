package c.tests.winter2018;
/**
 * This class adapts the arraylist contents so that they would be properly showed on the screen.
 * Also, it handles the action when the "delete employee" button is being pressed, it deletes that
 * employee from the table that contains the company's current employees and it copies that record
 * to the table that contains all of the company's employees that do not work to the company anymore.
 */

import android.content.Context;
import android.content.DialogInterface;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentTransaction;
import android.support.v7.app.AlertDialog;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.List;

import static android.content.ContentValues.TAG;


public class Custom_Adapter_View_Users extends ArrayAdapter<Listnode_View_Users> {
    private Connection conn; // the connection to the database


    public Custom_Adapter_View_Users(Context context, int textViewResourceId, List<Listnode_View_Users> objects, FragmentManager manager) {
        super(context, textViewResourceId, objects);
    }

    @Override
    public View getView(final int position, View convertView, ViewGroup parent) {

        ViewHolder viewHolder = null;

        // gets the text views from the screen
        if (convertView == null) {
            LayoutInflater inflater = (LayoutInflater)
                    getContext().getSystemService(Context.LAYOUT_INFLATER_SERVICE);
            convertView = inflater.inflate(R.layout.layo_view_users, null);
            viewHolder = new ViewHolder();
            viewHolder.Email = (TextView) convertView.findViewById(R.id.test4);
            viewHolder.Name = (TextView) convertView.findViewById(R.id.test2);
            viewHolder.Surname = (TextView) convertView.findViewById(R.id.test3);

            convertView.setTag(viewHolder);
        } else {
            viewHolder = (ViewHolder) convertView.getTag();
        }

        // sets the right text to those text views
        final Listnode_View_Users l = (Listnode_View_Users) getItem(position);
        viewHolder.Name.setText(l.Name);
        viewHolder.Surname.setText(l.Surname);
        viewHolder.Email.setText(l.Email);


        //viewHolder = (ViewHolder) convertView.getTag();





        return convertView;
    }

    /* This method is responsible for executing the query that will delete that employee and transfer
     * that recording to the table "deletedEmployee"

    private void deleteEmployee(String username) {
        ConnectDB connection = new ConnectDB();
        conn = connection.establishConnection(); // establishes connection to the db

        // This query deletes that employee and copies it to the "deletedEmployee" table
        String query = "INSERT INTO `DeletedEmployee` " +
                "SELECT `Username`, `ID`, `Name`, `Surname`, `Birthdate`, `Gender`, `Address`, `Country`, `Phone`, `EmergencyPhone`, `Role`, `Salary`, `SalaryType`, `SSN`, `Email`, `Photo` " +
                "FROM `Employee` WHERE `Username` = ?";
        String getDept = "Select NumDept FROM  `Employee`  WHERE  `Username` = '" + username + "'";
        String delete = "DELETE FROM `Employee` WHERE `Username` = ?";

        PreparedStatement stmt = null;

        if (conn == null)
            return;

        // Executes queries
        try {
            // inserts into the deleted employee the employee that will be deleted
            stmt = conn.prepareStatement(query);
            stmt.setString(1, username);
            stmt.execute();

            // removes him out of the department
            Statement st = conn.createStatement();
            ResultSet rs = st.executeQuery(getDept);
            String department = "0";
            if (rs.next()) department = rs.getString(1);

            String sqlDept = "UPDATE `Department` SET `NumEmployees`=`NumEmployees`-1 WHERE `NumberDept` = '" + department + "'";
            // Create and execute statement
            stmt = conn.prepareStatement(sqlDept);
            stmt.execute();

            // deletes employee from the employee table
            stmt = conn.prepareStatement(delete);
            stmt.setString(1, username);
            stmt.execute();

        } catch (SQLException e) {
            Log.e(TAG, e.getMessage());
        }
        Toast.makeText(getContext(), "The " + username + " has been deleted \n Please refresh", Toast.LENGTH_LONG).show();
    }

    /*
     * This method is responsible for handling the alert box that will contain the employee's
     * data for that record.

    private void onClickOptimized(Listnode_View_Employees l) {
        final AlertDialog.Builder alertDialog = new AlertDialog.Builder(getContext());
        alertDialog.setTitle(l.Username);

        alertDialog.setMessage(getData(l));
        alertDialog.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });

        alertDialog.show();
    }

    /* This method is responsible for executing the query that will get the employee's data
     */
    /*private String getData(Listnode_View_Users l) {
        String query= "Select * From Users";

        ConnectDB connection = new ConnectDB();
        conn = connection.establishConnection(); // establishes connection to the db

        if (conn == null)
            return null;

        try {
            Statement stmt = conn.createStatement();
            ResultSet rs;

            rs= stmt.executeQuery(query);





        } catch (SQLException e) {
            Log.e("Statare", e.getMessage());
        }



        return ("ID: " + l.ID + "\nName: " + l.Name + "\nSurname: " + l.Surname );
    }*/


    /* This class sets that textviews and button for each element on the list */
    private class ViewHolder {
        TextView Name;
        TextView Surname;
        TextView Email;
        ImageButton edit;
        ImageButton button;
    }
}