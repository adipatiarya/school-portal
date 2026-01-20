import { icon } from "@fortawesome/fontawesome-svg-core";
import { defineStore } from "pinia";

export const useAppSidebarMenuStore = defineStore("appSidebarMenu", {
  state: () => ({ menus: [] as any }),

  actions: {
    setSidebarMenu(perimissions: Array<string>) {
      const perms = [
        { text: "", is_header: true },
        {
          url: "/dashboard",
          img: "",
          icon: "fa fa-grip",
          title: "Dashboard",
          show: true,
        },
        { text: "Web Portal", is_header: true },
        {
          title: "Artikel dan Berita",
          icon: "fa fa-newspaper-o",
          children: [
            {
              url: "/posts",
              title: "List",
              show: true,
            },
            {
              url: "/posts/create",
              title: "Add new",
              show: true,
            },
            {
              url: "/posts/categories",
              title: "Kategori",
              show: true,
            },
          ],
        },
        {
          url: "/media",
          img: "",
          title: "Media",
          icon: "fa fa-image",
          show: true,
        },
        {
          title: "Pages",
          icon: "fa fa-note-sticky",
          children: [
            {
              url: "/pages",
              title: "List",
              show: true,
            },
            {
              url: "/pages/create",
              title: "Add new",
              show: true,
            },
          ],
        },
        {
          url: "/comments",
          title: "Comments",
          show: true,
          icon: "fa fa-comments",
        },
        { text: "", is_divider: true },
        { text: "Office Management", is_header: true },
        {
          title: "Akademik",
          icon: "fa fa-university",
          children: [
            {
              title: "Jadwal Kelas",
              show: true,
              children: [
                {
                  url: "/users",
                  title: "List Jadwal",
                  show: true,
                },
                {
                  url: "/users/create",
                  title: "Tambah Jadwal",
                  show: true,
                },
              ],
            },
            {
              title: "Data Mata Pelajaran",
              show: true,
              children: [
                {
                  url: "/users",
                  title: "List Mata Pelajaran",
                  show: true,
                },
                {
                  url: "/users/create",
                  title: "Tambah Mata Pelajaran",
                  show: true,
                },
              ],
            },
            {
              title: "Nilai & Rapor",
              show: true,
              children: [
                {
                  url: "/users",
                  title: "List Nilai & Rapor",
                  show: true,
                },
                {
                  url: "/users/create",
                  title: "Tambah Nilai & Rapor",
                  show: true,
                },
              ],
            },
          ],
        },
        {
          title: "LMS",
          icon: "fa fa-graduation-cap",
          children: [
            {
              url: "/roles",
              title: "Materi & Tugas",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Bank Soal",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Forum Diskusi",
              show: true,
            },
          ],
        },
        {
          title: "Siswa",
          icon: "fa fa-users",
          children: [
            {
              url: "/roles",
              title: "Data Siswa",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Absensi",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Prestasi & Catatan",
              show: true,
            },
          ],
        },
        {
          title: "Guru",
          icon: "fas fa-chalkboard-teacher",
          children: [
            {
              url: "/roles",
              title: "Data Guru",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Beban Mengajar",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Jadwal Mengajar",
              show: true,
            },
          ],
        },
        {
          title: "Administrasi",
          icon: "fa fa-credit-card",
          children: [
            {
              url: "/roles",
              title: "Pendaftaran",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Pembayaran",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Inventaris",
              show: true,
            },
          ],
        },
        {
          title: "Perpustakaan",
          icon: "fa-solid fa-book-open",
          children: [
            {
              url: "/roles",
              title: "Katalog Buku",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Peminjaman",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Denda",
              show: true,
            },
          ],
        },
        {
          title: "Komunikasi",
          icon: "fas fa-bullhorn",
          children: [
            {
              url: "/roles",
              title: "Pengumuman",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Pesan Orang Tua–Guru",
              show: true,
            },
          ],
        },
        {
          title: "Analitik",
          icon: "fa fa-line-chart",
          children: [
            {
              url: "/roles",
              title: "Kehadiran",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Nilai",
              show: true,
            },
            {
              url: "/roles/create",
              title: "Keuangan",
              show: true,
            },
          ],
        },
        { text: "", is_divider: true },
        {
          title: "Pengaturan",
          icon: "fa fa-cogs",

          children: [
            {
              title: "Role & Hak akses",
              show: true,
            },
            {
              url: "/setting",
              title: "Profil Sekolah",
              show: true,
            },
            {
              url: "/setting",
              title: "Backup & Audit log",
              show: true,
            },
          ],
        },
        {
          url: "/setting",
          title: "Manual Books",
          show: true,
          icon: "fa fa-book",
        },
      ];
      this.menus = perms;
    },
  },
});
