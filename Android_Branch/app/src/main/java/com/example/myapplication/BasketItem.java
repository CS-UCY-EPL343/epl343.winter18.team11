package com.example.myapplication;

/**
 * Created by apple on 21/02/16.
 */
public class BasketItem {
    private String title="";
    private boolean checked=false;
    public BasketItem(String title,boolean checked)
    {
        this.title=title;
        this.checked=checked;
    }
    public boolean isChecked() {
        return checked;
    }
    public void setChecked(boolean checked) {
        this.checked = checked;
    }
    public String getTitle() {
        return title;
    }
    public void setTitle(String title) {
        this.title = title;
    }
}