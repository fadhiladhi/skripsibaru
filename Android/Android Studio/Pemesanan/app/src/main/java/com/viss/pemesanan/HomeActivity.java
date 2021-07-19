package com.viss.pemesanan;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Toast;

import com.ismaeldivita.chipnavigation.ChipNavigationBar;
import com.viss.pemesanan.Fragment.DataIkanFragment;
import com.viss.pemesanan.Fragment.DataPengirimanFragment;
import com.viss.pemesanan.Fragment.PemesananFragment;

public class HomeActivity extends AppCompatActivity {
    ChipNavigationBar navigationBar;
    private SessionHandler session;
    FragmentManager fragmentManager;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        session = new SessionHandler(getApplicationContext());
        setContentView(R.layout.activity_home);
        getSupportActionBar().hide();

        navigationBar = findViewById(R.id.nav_bar);

        navigationBar.setOnItemSelectedListener(new ChipNavigationBar.OnItemSelectedListener() {
            @Override
            public void onItemSelected(int id) {
                Fragment fragment = null;
                switch (id){
                    case R.id.dataikan:
                        fragment = new DataIkanFragment();
                        break;
                    case R.id.datapengiriman:
                        fragment = new DataPengirimanFragment();
                        break;
                    case R.id.menu_pemesanan:
                        fragment = new PemesananFragment();
                        break;
                    case R.id.logout:
                        new AlertDialog.Builder(HomeActivity.this).setTitle("Konfirmasi").setMessage("Anda yakin mau logout ?")
                                .setIcon(android.R.drawable.ic_dialog_alert)
                                .setPositiveButton("Ya, Logout", (dialog, whichButton) -> {
                                    session.logoutUser();
                                    Intent intent = new Intent(HomeActivity.this, MainActivity.class);
                                    intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                                    startActivity(intent);
                                    finish();
                                })
                                .setNegativeButton("Tidak", null).show();
                }
                if(fragment!=null){
                    fragmentManager = getSupportFragmentManager();
                    fragmentManager.beginTransaction().replace(R.id.framelayout, fragment).commit();
                }else{
                    Toast.makeText(getApplicationContext(), "FRAGMENT ERROR", Toast.LENGTH_SHORT).show();
                }

            }
        });
    }
}