document.querySelectorAll('.btnDetail').forEach(item => {
    item.addEventListener('click', (e) => {
        let parent = e.target.parentNode.parentNode;

        let gambar = parent.querySelector('.card-img-top').src;
        let harga = parent.querySelector('.harga').innerHTML;
        let judul = parent.querySelector('.card-text').innerHTML;
        let deskripsi = parent.querySelector('.deskripsi') ? parent.querySelector('.deskripsi').innerHTML : '<i>tidak ada informasi yang tersedia</i>';

        // Membersihkan konten modal sebelum menambahkan konten baru
        document.querySelector('.modalImage').innerHTML = ''; // Membersihkan gambar modal sebelumnya
        document.querySelector('.modalDeskripsi').innerHTML = ''; // Membersihkan deskripsi modal sebelumnya

        // Memunculkan modal
        let tombolModal = document.querySelector('.btnModal');
        tombolModal.click();

        // Memasukkan data ke dalam modal
        document.querySelector('.modalTitle').innerHTML = judul;
        let image = document.createElement('img');
        image.src = gambar;
        image.classList.add('w-100');
        document.querySelector('.modalImage').appendChild(image);
        document.querySelector('.modalDeskripsi').innerHTML = deskripsi;
        document.querySelector('.modalHarga').innerHTML = harga;

        // Membuat link beli dengan nomor WhatsApp statis
        const nohp = '08123456789';
        let pesan = `https://api.whatsapp.com/send?phone=${nohp}&text=Hallo, saya mau pesan produk ini ${judul}`;
        document.querySelector('.btnBeli').href = pesan;
    });
});
