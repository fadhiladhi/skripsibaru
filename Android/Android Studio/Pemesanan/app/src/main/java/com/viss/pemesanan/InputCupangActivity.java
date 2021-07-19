package com.viss.pemesanan;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AlertDialog;
import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.request.JsonObjectRequest;
import com.bumptech.glide.Glide;
import com.viss.pemesanan.Model.UserModel;

import org.json.JSONException;
import org.json.JSONObject;

public class InputCupangActivity extends AppCompatActivity {
    private ProgressDialog pDialog;
    public static final String url = "http://347f969e2cb4.ngrok.io/db_pemesanan/get_cupang.php";
    public static final String url_tambah = "http://347f969e2cb4.ngrok.io/db_pemesanan/tambah_pemesanan.php";
    String id_cupang;
    TextView nama, harga, stock, deskripsi, jenis;
    ImageView gambar;
    Button simpan;
    String img_url;
    UserModel user;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_input_cupang);
        getSupportActionBar().hide();
        Bundle extras = getIntent().getExtras();
        if (extras != null) {
            id_cupang = extras.getString("id");
        }
        SessionHandler session = new SessionHandler(this);
        user = session.getUserDetails();
        nama = findViewById(R.id.input_nama);
        harga = findViewById(R.id.input_harga);
        gambar = findViewById(R.id.input_gambar);
        deskripsi = findViewById(R.id.input_deskripsi);
        jenis = findViewById(R.id.input_jenis);
        simpan = findViewById(R.id.btn_input_penjualan);
        simpan.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                new AlertDialog.Builder(InputCupangActivity.this).setTitle("Konfirmasi").setMessage("Anda yakin ingin pesan?")
                        .setIcon(android.R.drawable.ic_dialog_alert)
                        .setPositiveButton("Ya", (dialog, whichButton) -> {
                            AddPemesanan();
                            onBackPressed();
                        })
                        .setNegativeButton("Tidak", null).show();
            }
        });

        getCupang();
    }



    private void displayLoader() {
        pDialog = new ProgressDialog(InputCupangActivity.this);
        pDialog.setMessage("Sedang diproses...");
        pDialog.setIndeterminate(false);
        pDialog.setCancelable(false);
        pDialog.show();
    }
    private void getCupang() {
        displayLoader();
        JSONObject request = new JSONObject();
        try {
            request.put("id", id_cupang);
        } catch (JSONException e) {
            e.printStackTrace();
        }
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url, request, response -> {
                    pDialog.dismiss();
                    try {
                        if (response.getInt("status") == 0) {
                            nama.setText(response.getString("namaikan"));
                            harga.setText(response.getString("harga"));
                            deskripsi.setText(response.getString("deskripsi"));
                            jenis.setText(response.getString("jenisikan"));
                            img_url = response.getString("img_url");
                            String url = "http://10.0.2.2/pemesanan/uploads/"+response.getString("img_url");
                            Glide.with(this).load(url).into(gambar);


                        } else {
                            Toast.makeText(getApplicationContext(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, error -> {
                    pDialog.dismiss();
                    Toast.makeText(getApplicationContext(),
                            error.getMessage(), Toast.LENGTH_SHORT).show();
                });

        MySingleton.getInstance(this).addToRequestQueue(jsArrayRequest);
    }
    private void AddPemesanan() {

        JSONObject request = new JSONObject();
        try {
            request.put("namaikan", nama.getText().toString());
            request.put("jenisikan", jenis.getText().toString());
            request.put("harga", harga.getText().toString());
            request.put("deskripsi", deskripsi.getText().toString());
            request.put("img_url", img_url);
            request.put("namapemesanan", user.getUsername());
        } catch (JSONException e) {
            e.printStackTrace();
        }
        JsonObjectRequest jsArrayRequest = new JsonObjectRequest
                (Request.Method.POST, url_tambah, request, response -> {

                    try {
                        if (response.getInt("status") == 0) {
                            Toast.makeText(getApplicationContext(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();

                            finish();
                        } else {
                            Toast.makeText(getApplicationContext(),
                                    response.getString("message"), Toast.LENGTH_SHORT).show();
                        }
                    } catch (JSONException e) {
                        e.printStackTrace();
                    }
                }, error -> {
                    pDialog.dismiss();
                    Toast.makeText(getApplicationContext(),
                            error.getMessage(), Toast.LENGTH_SHORT).show();
                });

        MySingleton.getInstance(this).addToRequestQueue(jsArrayRequest);
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
    }
}