package com.example.myapplication;

import android.annotation.SuppressLint;
import android.app.Activity;
import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.TextView;

import java.util.ArrayList;
    /**
     * Created by coderzpassion on 13/03/16.
     */
    public class BasketAdaptor {

        private Context mContext;
        ArrayList<BasketItem> mylist=new ArrayList<>();
        public BasketAdaptor(ArrayList<BasketItem> itemArray,Context mContext) {
            super();
            this.mContext = mContext;
            mylist=itemArray;
        }
        public int getCount() {
            return mylist.size();
        }

        public String getItem(int position) {
            return mylist.get(position).toString();
        }
        public long getItemId(int position) {
            return position;
        }
        public void onItemSelected(int position) {
        }
        public class ViewHolder {
            public TextView nametext;
            public CheckBox tick;
        }
        @SuppressLint("WrongViewCast")
        public View getView(final int position, View convertView,
                            ViewGroup parent) {
            // TODO Auto-generated method stub
            ViewHolder view = null;
            LayoutInflater inflator = ((Activity) mContext).getLayoutInflater();
            if (view == null) {
                view = new ViewHolder();
                convertView = inflator.inflate(R.layout.activity_basket, null);
                view.nametext = (TextView) convertView.findViewById(R.id.orderlist);
                view.tick=(CheckBox)convertView.findViewById(R.id.orderlist);
                view.tick.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                    @Override
                    public void onCheckedChanged(CompoundButton buttonView,
                                                 boolean isChecked) {
                        int getPosition = (Integer) buttonView.getTag(); // Here
                        // we get  the position that we have set for the checkbox using setTag.
                        mylist.get(getPosition).setChecked(buttonView.isChecked()); // Set the value of checkbox to maintain its state.
                        if (isChecked) {
                            //do sometheing here
                        }
                        else
                        {
                            // code here
                        }
                    }
                });
                convertView.setTag(view);
            } else {
                view = (ViewHolder) convertView.getTag();
            }
            view.tick.setTag(position);
            view.nametext.setText("" + mylist.get(position).getTitle());
            view.tick.setChecked(mylist.get(position).isChecked());
            return convertView;
        }
    }

