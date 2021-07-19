package com.viss.pemesanan;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.viss.pemesanan.Model.UserModel;

public class InputDataDiriActivity extends AppCompatActivity {
    String id_cupang;
    EditText nama, alamat, harga, deskripsi, jumlah;
    Button btn_wa;
    String Snama, Salamat, Sharga, Sdeskripsi, Sjumlah, Sid_user;
    UserModel user;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_input_data_diri);
        getSupportActionBar().hide();
        Bundle extras = getIntent().getExtras();
        SessionHandler session = new SessionHandler(this);
        user = session.getUserDetails();
        if (extras != null) {
            id_cupang = extras.getString("id");
            Toast.makeText(this, "id :"+id_cupang, Toast.LENGTH_LONG).show();
        }
        nama = findViewById(R.id.wa_nama);
        alamat = findViewById(R.id.wa_alamat);
        harga = findViewById(R.id.wa_harga);
        deskripsi = findViewById(R.id.wa_deskripsi);
        jumlah = findViewById(R.id.wa_jumlah);
        btn_wa = findViewById(R.id.btn_wa_penjualan);


        btn_wa.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Snama = nama.getText().toString();
                Salamat = alamat.getText().toString();
                Sharga = harga.getText().toString();
                Sdeskripsi = deskripsi.getText().toString();
                Sjumlah = jumlah.getText().toString();
                Sid_user = user.getId();
                Intent sendmsg = new Intent(Intent.ACTION_VIEW);
                String url = "https://api.whatsapp.com/send?phone=+6281310590699&text=Assalamaualaikum,...%0aSaya bernama "+Snama+"("+Sid_user+")%0aingin membeli ikan anda dengan data berikut: %0a%0aNama : "+Snama+" %0aalamat : "+Salamat+"%0aid Ikan : "+id_cupang+" %0aHarga : "+Sharga+" %0ajumlah : "+Sjumlah+" %0a%0aKak Tolong dibantu konfirmasi ya, ditunggu ya kak.... Terima kasih'";
                sendmsg.setPackage("com.whatsapp");
                sendmsg.setData(Uri.parse(url));
                startActivity(sendmsg);
            }
        });
    }
}