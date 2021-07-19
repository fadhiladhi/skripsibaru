package com.viss.pemesanan.Model;

public class Pemesanan {
    String id,namaikan,jenisikan,harga,deskripsi,img_url,namapemesanan;

    public Pemesanan() {
    }

    public Pemesanan(String id, String namaikan, String jenisikan, String harga, String deskripsi, String img_url, String namapemesanan) {
        this.id = id;
        this.namaikan = namaikan;
        this.jenisikan = jenisikan;
        this.harga = harga;
        this.deskripsi = deskripsi;
        this.img_url = img_url;
        this.namapemesanan = namapemesanan;
    }

    public String getId() {
        return id;
    }

    public void setId(String id) {
        this.id = id;
    }

    public String getNamaikan() {
        return namaikan;
    }

    public void setNamaikan(String namaikan) {
        this.namaikan = namaikan;
    }

    public String getJenisikan() {
        return jenisikan;
    }

    public void setJenisikan(String jenisikan) {
        this.jenisikan = jenisikan;
    }

    public String getHarga() {
        return harga;
    }

    public void setHarga(String harga) {
        this.harga = harga;
    }

    public String getDeskripsi() {
        return deskripsi;
    }

    public void setDeskripsi(String deskripsi) {
        this.deskripsi = deskripsi;
    }

    public String getImg_url() {
        return img_url;
    }

    public void setImg_url(String img_url) {
        this.img_url = img_url;
    }

    public String getNamapemesanan() {
        return namapemesanan;
    }

    public void setNamapemesanan(String namapemesanan) {
        this.namapemesanan = namapemesanan;
    }
}
