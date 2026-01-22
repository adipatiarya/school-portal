export enum RouterName {
  LOGIN = "login",
  REGISTER = "register",
  DASHBOARD = "dashboard",

  POSTS = "posts",
  POSTS_CREATE = "posts_create",
  POSTS_UPDATE = "posts_update",
  POSTS_DETAIL = "posts_detail",
  POSTS_CATEGORIES = "posts_categories",

  MEDIA = "media",

  PAGES = "pages",
  PAGES_CREATE = "pages_create",
  PAGES_UPDATE = "pages_update",
  PAGES_DETAIL = "pages_detail",

  COMMENTS = "comments",

  STUDENTS = "students",
  TEACHERS = "teachers",
  SETTINGS = "settings",
  PROFILE = "profile",
}

export const chartOptions = {
  responsive: true,
  maintainAspectRatio: true,
  plugins: {
    legend: {
      display: false,
    },
    datalabels: {
      anchor: "end",
      align: "top",
      color: "#fff",

      font: {
        weight: "bold",
        size: 10,
      },
      formatter: (value) => `${value}%`, // optional kalau mau tambah %
    },
  },
  interaction: {
    mode: "index",
    intersect: false,
  },
  scales: {
    y: {
      border: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)",
        width: 0.5,
      },
      grid: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)", // Color of the interior grid lines
        width: 0.5,
      },
      beginAtZero: true,
      min: 0,
      max: 125,
      title: {
        display: true,
        text: "KEHADIRAN SISWA",

        font: {
          size: 12,
          weight: "bold",
        },
        color: "#fff",
      },
      ticks: {
        stepSize: 25,
        callback: function (value) {
          return value + "%";
        },
        color: "#fff",
      },
    },
    x: {
      border: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)", // Color of the vertical/horizontal axis line
        width: 0.5,
      },
      grid: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)", // Color of the interior grid lines
        width: 0.5,
      },
      ticks: {
        color: "#fff",
      },
    },
  },
};
