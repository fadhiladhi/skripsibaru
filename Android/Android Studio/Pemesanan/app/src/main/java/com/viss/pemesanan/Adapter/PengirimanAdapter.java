package com.viss.pemesanan.Adapter;

import android.content.Context;
import android.content.Intent;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.recyclerview.widget.RecyclerView;

import com.android.volley.ui.NetworkImageViewPlus;
import com.bumptech.glide.Glide;
import com.bumptech.glide.request.RequestOptions;
import com.viss.pemesanan.AccpetPengirimanActivity;
import com.viss.pemesanan.InputCupangActivity;
import com.viss.pemesanan.Model.Cupang;
import com.viss.pemesanan.Model.PengirimanModel;
import com.viss.pemesanan.R;

import java.util.ArrayList;

public class PengirimanAdapter extends RecyclerView.Adapter<PengirimanAdapter.MyViewHolder> {

    Context context;
    ArrayList<PengirimanModel> list;

    public PengirimanAdapter(Context context, ArrayList<PengirimanModel> list) {
        this.context = context;
        this.list = list;
    }

    @NonNull
    @Override
    public MyViewHolder onCreateViewHolder(@NonNull ViewGroup parent, int viewType) {

        View v = LayoutInflater.from(context).inflate(R.layout.view_datapengirman, parent, false);
        return new MyViewHolder(v);
    }

    @Override
    public void onBindViewHolder(@NonNull MyViewHolder holder, int position) {
        PengirimanModel pengirimanModel = list.get(position);
        holder.status.setText(pengirimanModel.getStatus());
        holder.jasapengiriman.setText(pengirimanModel.getJasapengiriman());
        holder.tglpemesanan.setText(pengirimanModel.getTglpemesanan());
        holder.noresi.setText(pengirimanModel.getNoresi());
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(context, AccpetPengirimanActivity.class);
                intent.addFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
                intent.putExtra("id",list.get(position).getId() );
                context.startActivity(intent);
            }
        });
    }

    @Override
    public int getItemCount() {
        return list.size();
    }


    public class MyViewHolder extends RecyclerView.ViewHolder {
        TextView namaikan,tglpemesanan, jasapengiriman, noresi, status;

        public MyViewHolder(@NonNull View itemView) {
            super(itemView);
            tglpemesanan = itemView.findViewById(R.id.pengiriman_tanggalpemesanan);
            jasapengiriman = itemView.findViewById(R.id.pengiriman_jasapengiriman);
            noresi = itemView.findViewById(R.id.pengiriman_noresi);
            status = itemView.findViewById(R.id.pengiriman_status);
        }
    }
}
