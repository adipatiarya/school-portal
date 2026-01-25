<script>
import { useAppVariableStore } from "@/stores/app-variable";
import { animateNumber } from "@/components/app/AnimateNumber.vue";
import apexchart from "@/components/plugins/Apexcharts.vue";
import AppLayout from "@/components/app/AppLayout.vue";
import jsVectorMap from "jsvectormap";
import "jsvectormap/dist/maps/world.js";
import "jsvectormap/dist/css/jsvectormap.min.css";
import $ from "jquery";

import "bootstrap-daterangepicker";

const appVariable = useAppVariableStore();

export default {
  components: {
    apexchart: apexchart,
    AppLayout: AppLayout,
  },
  mounted() {
    animateNumber();

    $("#daterange-filter").daterangepicker(
      {
        startDate: moment(this.dateRange.start, "D MMMM YYYY"),
        endDate: moment(this.dateRange.end, "D MMMM YYYY"),
        ranges: {
          "30 Hari Terakhir": [moment().subtract(29, "days"), moment()],
          "6 Bulan Terakhir": [moment().subtract(6, "months"), moment()],
          "1 Tahun Terakhir": [moment().subtract(1, "year"), moment()],
        },
        locale: {
          format: "D MMMM YYYY",
          applyLabel: "Terapkan",
          cancelLabel: "Batal",
          customRangeLabel: "Manual", // 👈 rename Custom Range
        },
      },
      (start, end) => {
        // update Vue state
        this.dateRange.start = start.format("D MMMM YYYY");
        this.dateRange.end = end.format("D MMMM YYYY");
      }
    );
  },
  data() {
    return {
      renderComponent: true,
      sales: this.getSalesData(),
      visitor: this.getVisitorData(),
      conversion: this.getConverstionData(),
      session: this.getSessionData(),
      markers: this.getMarkersData(),
      dateRange: {
        start: moment().subtract(6, "months").format("D MMMM YYYY"),
        end: moment().format("D MMMM YYYY"),
      },

      prevRange: {
        start: moment().subtract(12, "months").format("D MMMM YYYY"),
        end: moment().subtract(6, "months").format("D MMMM YYYY"),
      },
    };
  },
  methods: {
    convertNumberWithCommas(x) {
      return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    },
    getMarkersData() {
      return [
        { name: "Egypt", coords: [26.8206, 30.8025] },
        { name: "Russia", coords: [61.524, 105.3188] },
        { name: "Canada", coords: [56.1304, -106.3468] },
        { name: "Greenland", coords: [71.7069, -42.6043] },
        { name: "Brazil", coords: [-14.235, -51.9253] },
      ];
    },
    getVisitorData() {
      return {
        chart: {
          series: [
            {
              name: "Unique Visitors",
              data: [
                [this.handleGetDate(77), 13],
                [this.handleGetDate(76), 13],
                [this.handleGetDate(75), 6],
                [this.handleGetDate(73), 6],
                [this.handleGetDate(72), 6],
                [this.handleGetDate(71), 5],
                [this.handleGetDate(70), 5],
                [this.handleGetDate(69), 5],
                [this.handleGetDate(68), 6],
                [this.handleGetDate(67), 7],
                [this.handleGetDate(66), 6],
                [this.handleGetDate(65), 9],
                [this.handleGetDate(64), 9],
                [this.handleGetDate(63), 8],
                [this.handleGetDate(62), 10],
                [this.handleGetDate(61), 10],
                [this.handleGetDate(60), 10],
                [this.handleGetDate(59), 10],
                [this.handleGetDate(58), 9],
                [this.handleGetDate(57), 9],
                [this.handleGetDate(56), 10],
                [this.handleGetDate(55), 9],
                [this.handleGetDate(54), 9],
                [this.handleGetDate(53), 8],
                [this.handleGetDate(52), 8],
                [this.handleGetDate(51), 8],
                [this.handleGetDate(50), 8],
                [this.handleGetDate(49), 8],
                [this.handleGetDate(48), 7],
                [this.handleGetDate(47), 7],
                [this.handleGetDate(46), 6],
                [this.handleGetDate(45), 6],
                [this.handleGetDate(44), 6],
                [this.handleGetDate(43), 6],
                [this.handleGetDate(42), 5],
                [this.handleGetDate(41), 5],
                [this.handleGetDate(40), 4],
                [this.handleGetDate(39), 4],
                [this.handleGetDate(38), 5],
                [this.handleGetDate(37), 5],
                [this.handleGetDate(36), 5],
                [this.handleGetDate(35), 7],
                [this.handleGetDate(34), 7],
                [this.handleGetDate(33), 7],
                [this.handleGetDate(32), 10],
                [this.handleGetDate(31), 9],
                [this.handleGetDate(30), 9],
                [this.handleGetDate(29), 10],
                [this.handleGetDate(28), 11],
                [this.handleGetDate(27), 11],
                [this.handleGetDate(26), 8],
                [this.handleGetDate(25), 8],
                [this.handleGetDate(24), 7],
                [this.handleGetDate(23), 8],
                [this.handleGetDate(22), 9],
                [this.handleGetDate(21), 8],
                [this.handleGetDate(20), 9],
                [this.handleGetDate(19), 10],
                [this.handleGetDate(18), 9],
                [this.handleGetDate(17), 10],
                [this.handleGetDate(16), 16],
                [this.handleGetDate(15), 17],
                [this.handleGetDate(14), 16],
                [this.handleGetDate(13), 17],
                [this.handleGetDate(12), 16],
                [this.handleGetDate(11), 15],
                [this.handleGetDate(10), 14],
                [this.handleGetDate(9), 24],
                [this.handleGetDate(8), 18],
                [this.handleGetDate(7), 15],
                [this.handleGetDate(6), 14],
                [this.handleGetDate(5), 16],
                [this.handleGetDate(4), 16],
                [this.handleGetDate(3), 17],
                [this.handleGetDate(2), 7],
                [this.handleGetDate(1), 7],
                [this.handleGetDate(0), 7],
              ],
            },
            {
              name: "Page Views",
              data: [
                [this.handleGetDate(77), 14],
                [this.handleGetDate(76), 13],
                [this.handleGetDate(75), 15],
                [this.handleGetDate(73), 14],
                [this.handleGetDate(72), 13],
                [this.handleGetDate(71), 15],
                [this.handleGetDate(70), 16],
                [this.handleGetDate(69), 16],
                [this.handleGetDate(68), 14],
                [this.handleGetDate(67), 14],
                [this.handleGetDate(66), 13],
                [this.handleGetDate(65), 12],
                [this.handleGetDate(64), 13],
                [this.handleGetDate(63), 13],
                [this.handleGetDate(62), 15],
                [this.handleGetDate(61), 16],
                [this.handleGetDate(60), 16],
                [this.handleGetDate(59), 17],
                [this.handleGetDate(58), 17],
                [this.handleGetDate(57), 18],
                [this.handleGetDate(56), 15],
                [this.handleGetDate(55), 15],
                [this.handleGetDate(54), 15],
                [this.handleGetDate(53), 19],
                [this.handleGetDate(52), 19],
                [this.handleGetDate(51), 18],
                [this.handleGetDate(50), 18],
                [this.handleGetDate(49), 17],
                [this.handleGetDate(48), 16],
                [this.handleGetDate(47), 18],
                [this.handleGetDate(46), 18],
                [this.handleGetDate(45), 18],
                [this.handleGetDate(44), 16],
                [this.handleGetDate(43), 14],
                [this.handleGetDate(42), 14],
                [this.handleGetDate(41), 13],
                [this.handleGetDate(40), 14],
                [this.handleGetDate(39), 13],
                [this.handleGetDate(38), 10],
                [this.handleGetDate(37), 9],
                [this.handleGetDate(36), 10],
                [this.handleGetDate(35), 11],
                [this.handleGetDate(34), 11],
                [this.handleGetDate(33), 11],
                [this.handleGetDate(32), 10],
                [this.handleGetDate(31), 9],
                [this.handleGetDate(30), 10],
                [this.handleGetDate(29), 13],
                [this.handleGetDate(28), 14],
                [this.handleGetDate(27), 14],
                [this.handleGetDate(26), 13],
                [this.handleGetDate(25), 12],
                [this.handleGetDate(24), 11],
                [this.handleGetDate(23), 13],
                [this.handleGetDate(22), 13],
                [this.handleGetDate(21), 13],
                [this.handleGetDate(20), 13],
                [this.handleGetDate(19), 14],
                [this.handleGetDate(18), 13],
                [this.handleGetDate(17), 13],
                [this.handleGetDate(16), 19],
                [this.handleGetDate(15), 21],
                [this.handleGetDate(14), 22],
                [this.handleGetDate(13), 25],
                [this.handleGetDate(12), 24],
                [this.handleGetDate(11), 24],
                [this.handleGetDate(10), 22],
                [this.handleGetDate(9), 16],
                [this.handleGetDate(8), 15],
                [this.handleGetDate(7), 12],
                [this.handleGetDate(6), 12],
                [this.handleGetDate(5), 15],
                [this.handleGetDate(4), 15],
                [this.handleGetDate(3), 15],
                [this.handleGetDate(2), 18],
                [this.handleGetDate(2), 18],
                [this.handleGetDate(0), 17],
              ],
            },
          ],
          options: {
            colors: [appVariable.color.teal, appVariable.color.blue],
            fill: {
              opacity: 0.75,
              type: "solid",
            },
            legend: {
              position: "top",
              horizontalAlign: "right",
              offsetY: 15,
              offsetX: 500,
              labels: {
                colors: appVariable.color.white,
              },
            },
            xaxis: {
              type: "datetime",
              tickAmount: 6,
              labels: {
                style: {
                  colors: appVariable.color.white,
                },
              },
            },
            yaxis: {
              labels: {
                style: {
                  colors: appVariable.color.white,
                },
              },
            },
            tooltip: {
              y: {
                formatter: function (val) {
                  return "$ " + val + " thousands";
                },
              },
            },
            chart: {
              height: "100%",
              type: "area",
              toolbar: { show: false },
              stacked: true,
            },
            plotOptions: {
              bar: {
                horizontal: false,
                columnWidth: "55%",
                endingShape: "rounded",
              },
            },
            dataLabels: { enabled: false },
            grid: {
              show: true,
              borderColor: "rgba(" + appVariable.color.whiteRgb + ", .15)",
              xaxis: {
                lines: {
                  show: true,
                },
              },
              yaxis: {
                lines: {
                  show: true,
                },
              },
              padding: {
                top: -40,
                right: 3,
                bottom: 0,
                left: 10,
              },
            },
            stroke: {
              show: false,
              curve: "straight",
            },
          },
        },
        pieChart: {
          height: 180,
          series: [416747, 784466],
          options: {
            labels: ["New Visitors", "Return Visitors"],
            chart: { type: "donut" },
            dataLabels: {
              dropShadow: { enabled: false },
              style: { colors: ["#fff"] },
            },
            stroke: { show: false },
            colors: [appVariable.color.blue, appVariable.color.teal],
            legend: { show: false },
          },
        },
      };
    },
    getSalesData() {
      return {
        chart: {
          series: [
            {
              data: [
                9452.37, 11018.87, 7296.37, 6274.29, 7924.05, 6581.34, 12918.14,
              ],
            },
          ],
          options: {
            xaxis: {
              axisBorder: {
                show: false,
              },
            },
            chart: {
              type: "line",
              width: 100,
              height: 36,
              sparkline: {
                enabled: true,
              },
              stacked: true,
            },
            stroke: {
              curve: "smooth",
              width: 3,
            },
            fill: {
              type: "gradient",
              gradient: {
                opacityFrom: 1,
                opacityTo: 1,
                colorStops: [
                  {
                    offset: 0,
                    color: appVariable.color.blue,
                    opacity: 1,
                  },
                  {
                    offset: 100,
                    color: appVariable.color.indigo,
                    opacity: 1,
                  },
                ],
              },
            },
            tooltip: {
              theme: "dark",
              fixed: {
                enabled: false,
              },
              x: {
                show: false,
              },
              y: {
                title: {
                  formatter: function (seriesName) {
                    return "";
                  },
                },
                formatter: (value) => {
                  return "$" + this.convertNumberWithCommas(value);
                },
              },
              marker: {
                show: false,
              },
            },
            responsive: [
              {
                breakpoint: 3000,
                options: {
                  chart: {
                    width: 130,
                  },
                },
              },
              {
                breakpoint: 1450,
                options: {
                  chart: {
                    width: 100,
                  },
                },
              },
              {
                breakpoint: 1300,
                options: {
                  chart: {
                    width: 90,
                  },
                },
              },
              {
                breakpoint: 1200,
                options: {
                  chart: {
                    width: 200,
                  },
                },
              },
              {
                breakpoint: 576,
                options: {
                  chart: {
                    width: 180,
                  },
                },
              },
              {
                breakpoint: 400,
                options: {
                  chart: {
                    width: 120,
                  },
                },
              },
            ],
          },
        },
      };
    },
    getConverstionData() {
      return {
        chart: {
          series: [
            {
              data: [2.68, 2.93, 2.04, 1.61, 1.88, 1.62, 2.8],
            },
          ],
          options: {
            xaxis: {
              axisBorder: {
                show: false,
              },
              crosshairs: {
                width: 1,
              },
            },
            chart: {
              type: "line",
              width: 160,
              height: 28,
              sparkline: {
                enabled: true,
              },
            },
            stroke: {
              curve: "smooth",
              width: 3,
            },
            fill: {
              type: "gradient",
              gradient: {
                opacityFrom: 1,
                opacityTo: 1,
                colorStops: [
                  {
                    offset: 0,
                    color: appVariable.color.red,
                    opacity: 1,
                  },
                  {
                    offset: 50,
                    color: appVariable.color.orange,
                    opacity: 1,
                  },
                  {
                    offset: 100,
                    color: appVariable.color.lime,
                    opacity: 1,
                  },
                ],
              },
            },
            labels: [
              "Jun 23",
              "Jun 24",
              "Jun 25",
              "Jun 26",
              "Jun 27",
              "Jun 28",
              "Jun 29",
            ],
            tooltip: {
              theme: "dark",
              fixed: {
                enabled: false,
              },
              x: {
                show: false,
              },
              y: {
                title: {
                  formatter: function (seriesName) {
                    return "";
                  },
                },
                formatter: (value) => {
                  return value + "%";
                },
              },
              marker: {
                show: false,
              },
            },
            responsive: [
              {
                breakpoint: 3000,
                options: {
                  chart: {
                    width: 120,
                  },
                },
              },
              {
                breakpoint: 1450,
                options: {
                  chart: {
                    width: 100,
                  },
                },
              },
              {
                breakpoint: 1300,
                options: {
                  chart: {
                    width: 90,
                  },
                },
              },
              {
                breakpoint: 1200,
                options: {
                  chart: {
                    width: 160,
                  },
                },
              },
              {
                breakpoint: 900,
                options: {
                  chart: {
                    width: 120,
                  },
                },
              },
              {
                breakpoint: 576,
                options: {
                  chart: {
                    width: 180,
                  },
                },
              },
              {
                breakpoint: 400,
                options: {
                  chart: {
                    width: 120,
                  },
                },
              },
            ],
          },
        },
      };
    },
    getSessionData() {
      return {
        chart: {
          series: [
            {
              data: [10812, 11393, 7311, 6834, 9612, 11200, 13557],
            },
          ],
          options: {
            xaxis: {
              axisBorder: {
                show: false,
              },
              crosshairs: {
                width: 1,
              },
            },
            chart: {
              type: "line",
              width: 160,
              height: 28,
              sparkline: {
                enabled: true,
              },
            },
            stroke: {
              curve: "smooth",
              width: 3,
            },
            fill: {
              type: "gradient",
              gradient: {
                opacityFrom: 1,
                opacityTo: 1,
                colorStops: [
                  {
                    offset: 0,
                    color: appVariable.color.teal,
                    opacity: 1,
                  },
                  {
                    offset: 50,
                    color: appVariable.color.blue,
                    opacity: 1,
                  },
                  {
                    offset: 100,
                    color: appVariable.color.cyan,
                    opacity: 1,
                  },
                ],
              },
            },
            labels: [
              "Jun 23",
              "Jun 24",
              "Jun 25",
              "Jun 26",
              "Jun 27",
              "Jun 28",
              "Jun 29",
            ],
            tooltip: {
              theme: "dark",
              fixed: {
                enabled: false,
              },
              x: {
                show: false,
              },
              y: {
                title: {
                  formatter: function (seriesName) {
                    return "";
                  },
                },
                formatter: (value) => {
                  return value + "%";
                },
              },
              marker: {
                show: false,
              },
            },
            responsive: [
              {
                breakpoint: 3000,
                options: {
                  chart: {
                    width: 120,
                  },
                },
              },
              {
                breakpoint: 1450,
                options: {
                  chart: {
                    width: 100,
                  },
                },
              },
              {
                breakpoint: 1300,
                options: {
                  chart: {
                    width: 90,
                  },
                },
              },
              {
                breakpoint: 1200,
                options: {
                  chart: {
                    width: 160,
                  },
                },
              },
              {
                breakpoint: 900,
                options: {
                  chart: {
                    width: 120,
                  },
                },
              },
              {
                breakpoint: 576,
                options: {
                  chart: {
                    width: 180,
                  },
                },
              },
              {
                breakpoint: 400,
                options: {
                  chart: {
                    width: 120,
                  },
                },
              },
            ],
          },
        },
      };
    },
    renderMap() {
      document.getElementById("map-container").innerHTML =
        '<div id="map"></div>';
      var map = new jsVectorMap({
        selector: "#map",
        map: "world",
        zoomButtons: false,
        normalizeFunction: "polynomial",
        hoverOpacity: 0.5,
        hoverColor: false,
        zoomOnScroll: false,
        selectedRegions: ["IN", "US", "MN", "RU"],
        series: { regions: [{ normalizeFunction: "polynomial" }] },
        labels: { markers: { render: (marker) => marker.name } },
        focusOn: { x: 0.5, y: 0.5, scale: 1 },
        markerStyle: {
          initial: { fill: appVariable.color.theme, stroke: "none", r: 5 },
          hover: { fill: appVariable.color.theme },
        },
        markerLabelStyle: {
          initial: {
            fontFamily: appVariable.font.family,
            fontSize: "12px",
            fill: "rgba(" + appVariable.color.whiteRgb + ", .75)",
          },
        },
        regionStyle: {
          initial: {
            fill: appVariable.color.gray700,
            fillOpacity: 4,
            stroke: "none",
            strokeWidth: 0.4,
            strokeOpacity: 1,
          },
          hover: { fillOpacity: 0.5 },
          selected: { fill: appVariable.color.teal, fillOpacity: 1 },
        },
        backgroundColor: "transparent",
      });
    },
    randomNo() {
      return Math.floor(Math.random() * 60) + 30;
    },
    handleGetDate(minusDate) {
      var d = new Date();
      d = d.setDate(d.getDate() - minusDate);
      return d;
    },
  },
};
</script>
<template>
  <app-layout>
    <h1 class="page-header mb-3">Dashboard</h1>

    <div class="row">
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-teal">
          <div class="stats-icon stats-icon-lg">
            <i class="fa fa-users fa-fw"></i>
          </div>
          <div class="stats-content">
            <div class="stats-title">TOTAL SISWA</div>
            <div class="stats-number">7,842,900</div>
            <div class="stats-link">
              <a href="javascript:;"
                >View Detail <i class="fa fa-arrow-alt-circle-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-blue">
          <div class="stats-icon stats-icon-lg">
            <i class="fa fa-dollar-sign fa-fw"></i>
          </div>
          <div class="stats-content">
            <div class="stats-title">TOTAL GURU</div>
            <div class="stats-number">180,200</div>
            <div class="stats-link">
              <a href="javascript:;"
                >View Detail <i class="fa fa-arrow-alt-circle-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-indigo">
          <div class="stats-icon stats-icon-lg">
            <i class="fa fa-archive fa-fw"></i>
          </div>
          <div class="stats-content">
            <div class="stats-title">TOTAL MATA PELAJARAN</div>
            <div class="stats-number">38,900</div>
            <div class="stats-link">
              <a href="javascript:;"
                >View Detail <i class="fa fa-arrow-alt-circle-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-dark">
          <div class="stats-icon stats-icon-lg">
            <i class="fa fa-comment-alt fa-fw"></i>
          </div>
          <div class="stats-content">
            <div class="stats-title">TOTAL JURUSAN</div>
            <div class="stats-number">3,988</div>
            <div class="stats-link">
              <a href="javascript:;"
                >View Detail <i class="fa fa-arrow-alt-circle-right"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
    </div>
    <!-- END row -->
    <!-- BEGIN row -->
    <div class="row">
      <!-- BEGIN col-8 -->
      <div class="col-xl-8 col-lg-6">
        <!-- BEGIN card -->
        <div class="card border-0 mb-3 bg-gray-800 text-white">
          <div class="card-body">
            <div class="mb-3 text-gray-500">
              <b>VISITORS ANALYTICS</b>
              <span class="ms-2"
                ><i
                  class="fa fa-info-circle"
                  data-bs-toggle="popover"
                  data-bs-trigger="hover"
                  data-bs-title="Top products with units sold"
                  data-bs-placement="top"
                  data-bs-content="Products with the most individual units sold. Includes orders from all sales channels."
                  data-original-title=""
                  title=""
                ></i
              ></span>
            </div>
            <div class="row">
              <div class="col-xl-3 col-4">
                <h3 class="mb-1">
                  <span data-animation="number" data-value="127.1">0</span>K
                </h3>
                <div>New Visitors</div>
                <div class="text-gray-500 small text-truncate">
                  <i class="fa fa-caret-up"></i>
                  <span data-animation="number" data-value="25.5">0.00</span>%
                  from previous 7 days
                </div>
              </div>
              <div class="col-xl-3 col-4">
                <h3 class="mb-1">
                  <span data-animation="number" data-value="179.9">0</span>K
                </h3>
                <div>Returning Visitors</div>
                <div class="text-gray-500 small text-truncate">
                  <i class="fa fa-caret-up"></i>
                  <span data-animation="number" data-value="5.33">0.00</span>%
                  from previous 7 days
                </div>
              </div>
              <div class="col-xl-3 col-4">
                <h3 class="mb-1">
                  <span data-animation="number" data-value="766.8">0</span>K
                </h3>
                <div>Total Page Views</div>
                <div class="text-gray-500 small text-truncate">
                  <i class="fa fa-caret-up"></i>
                  <span data-animation="number" data-value="0.323">0.00</span>%
                  from previous 7 days
                </div>
              </div>
            </div>
          </div>
          <div class="card-body pe-3 ps-0 py-0">
            <apexchart
              type="bar"
              width="100%"
              height="252"
              :options="visitor.chart.options"
              :series="visitor.chart.series"
            ></apexchart>
          </div>
        </div>
        <!-- END card -->
      </div>
      <!-- END col-8 -->

      <div class="col-xl-4 col-lg-6">
        <div class="widget-chart inverse-mode">
          <div class="widget-chart-sidebar bg-gray-900" style="width: 100%">
            <div class="d-flex justify-content-between">
              <div class="mb-3 text-gray-500">
                <b>PEMBAYARAN SPP</b>
                <span class="ms-2"
                  ><i
                    class="fa fa-info-circle"
                    data-bs-toggle="popover"
                    data-bs-trigger="hover"
                    data-bs-title="Top products with units sold"
                    data-bs-placement="top"
                    data-bs-content="Products with the most individual units sold. Includes orders from all sales channels."
                    data-original-title=""
                    title=""
                  ></i
                ></span>
              </div>
              <div class="chart-number">
                Rp 1,225,729
                <small>Semester genap</small>
              </div>
            </div>

            <div
              class="d-flex align-items-center justify-content-center"
              style="height: 250px"
            >
              <apexchart
                :height="220"
                :options="visitor.pieChart.options"
                :series="visitor.pieChart.series"
              ></apexchart>
            </div>

            <ul class="chart-legend fs-11px">
              <li>
                <i
                  class="fa fa-circle fa-fw text-blue fs-9px me-5px t-minus-1"
                ></i>
                34.0% <span>Siswa yang belum melunasi semester ini</span>
              </li>
              <li>
                <i
                  class="fa fa-circle fa-fw text-teal fs-9px me-5px t-minus-1"
                ></i>
                56.0% <span>Siswa yang sudah melunasi semester ini</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- END row -->
    <!-- BEGIN row -->
    <div class="row">
      <!-- BEGIN col-4 -->
      <div class="col-xl-4 col-lg-6">
        <!-- BEGIN card -->
        <div class="card border-0 mb-3 bg-gray-900 text-white">
          <!-- BEGIN card-body -->
          <div
            class="card-body"
            style="
              background: no-repeat bottom right;
              background-image: url(/assets/img/svg/img-4.svg);
              background-size: auto 60%;
            "
          >
            <!-- BEGIN title -->
            <div class="mb-3 text-gray-500">
              <b>SALES BY SOCIAL SOURCE</b>
              <span class="text-gray-500 ms-2"
                ><i
                  class="fa fa-info-circle"
                  data-bs-toggle="popover"
                  data-bs-trigger="hover"
                  data-bs-title="Sales by social source"
                  data-bs-placement="top"
                  data-bs-content="Total online store sales that came from a social referrer source."
                ></i
              ></span>
            </div>
            <!-- END title -->
            <!-- BEGIN sales -->
            <h3 class="mb-10px">
              $<span data-animation="number" data-value="55547.89">0.00</span>
            </h3>
            <!-- END sales -->
            <!-- BEGIN percentage -->
            <div class="text-gray-500 mb-1px">
              <i class="fa fa-caret-up"></i>
              <span data-animation="number" data-value="45.76">0.00</span>%
              increased
            </div>
            <!-- END percentage -->
          </div>
          <!-- END card-body -->
          <!-- BEGIN widget-list -->
          <div class="widget-list rounded-bottom" data-bs-theme="dark">
            <!-- BEGIN widget-list-item -->
            <a href="#" class="widget-list-item rounded-0 pt-3px">
              <div class="widget-list-media icon">
                <i class="fab fa-apple bg-indigo text-white"></i>
              </div>
              <div class="widget-list-content">
                <div class="widget-list-title">Apple Store</div>
              </div>
              <div class="widget-list-action text-nowrap text-gray-500">
                $<span data-animation="number" data-value="34840.17">0.00</span>
              </div>
            </a>
            <!-- END widget-list-item -->
            <!-- BEGIN widget-list-item -->
            <a href="#" class="widget-list-item">
              <div class="widget-list-media icon">
                <i class="fab fa-facebook-f bg-blue text-white"></i>
              </div>
              <div class="widget-list-content">
                <div class="widget-list-title">Facebook</div>
              </div>
              <div class="widget-list-action text-nowrap text-gray-500">
                $<span data-animation="number" data-value="12502.67">0.00</span>
              </div>
            </a>
            <!-- END widget-list-item -->
            <!-- BEGIN widget-list-item -->
            <a href="#" class="widget-list-item">
              <div class="widget-list-media icon">
                <i class="fab fa-twitter bg-info text-white"></i>
              </div>
              <div class="widget-list-content">
                <div class="widget-list-title">Twitter</div>
              </div>
              <div class="widget-list-action text-nowrap text-gray-500">
                $<span data-animation="number" data-value="4799.20">0.00</span>
              </div>
            </a>
            <!-- END widget-list-item -->
            <!-- BEGIN widget-list-item -->
            <a href="#" class="widget-list-item">
              <div class="widget-list-media icon">
                <i class="fab fa-google bg-red text-white"></i>
              </div>
              <div class="widget-list-content">
                <div class="widget-list-title">Google Adwords</div>
              </div>
              <div class="widget-list-action text-nowrap text-gray-500">
                $<span data-animation="number" data-value="3405.85">0.00</span>
              </div>
            </a>
            <!-- END widget-list-item -->
            <!-- BEGIN widget-list-item -->
            <a href="#" class="widget-list-item pb-3px rounded-bottom">
              <div class="widget-list-media icon">
                <i class="fab fa-instagram bg-pink text-white"></i>
              </div>
              <div class="widget-list-content">
                <div class="widget-list-title">Instagram</div>
              </div>
              <div class="widget-list-action text-nowrap text-gray-500">
                $<span data-animation="number" data-value="0.00">0.00</span>
              </div>
            </a>
            <!-- END widget-list-item -->
          </div>
          <!-- END widget-list -->
        </div>
        <!-- END card -->
      </div>
      <!-- END col-4 -->
      <!-- END col-4 -->
      <!-- BEGIN col-4 -->
      <div class="col-xl-4 col-lg-6">
        <!-- BEGIN card -->
        <div class="card border-0 mb-3 bg-gray-800 text-white">
          <!-- BEGIN card-body -->
          <div class="card-body">
            <!-- BEGIN title -->
            <div class="mb-3 text-gray-500">
              <b>JURUSAN PALING BANYAK PEMINAT</b>
              <span class="ms-2"
                ><i
                  class="fa fa-info-circle"
                  data-bs-toggle="popover"
                  data-bs-trigger="hover"
                  data-bs-title="Top products with units sold"
                  data-bs-placement="top"
                  data-bs-content="Products with the most individual units sold. Includes orders from all sales channels."
                ></i
              ></span>
            </div>
            <!-- END title -->
            <!-- BEGIN product -->
            <div class="d-flex align-items-center mb-15px">
              <div class="widget-img rounded-3 me-10px bg-white p-3px w-30px">
                <div
                  class="h-100 w-100"
                  style="
                    background: url(../assets/img/product/product-8.jpg) center
                      no-repeat;
                    background-size: auto 100%;
                  "
                ></div>
              </div>
              <div class="text-truncate">
                <div>Apple iPhone XR (2024)</div>
                <div class="text-gray-500">$799.00</div>
              </div>
              <div class="ms-auto text-center">
                <div class="fs-13px">
                  <span data-animation="number" data-value="195">0</span>
                </div>
                <div class="text-gray-500 fs-10px">sold</div>
              </div>
            </div>
            <!-- END product -->
            <!-- BEGIN product -->
            <div class="d-flex align-items-center mb-15px">
              <div class="widget-img rounded-3 me-10px bg-white p-3px w-30px">
                <div
                  class="h-100 w-100"
                  style="
                    background: url(../assets/img/product/product-9.jpg) center
                      no-repeat;
                    background-size: auto 100%;
                  "
                ></div>
              </div>
              <div class="text-truncate">
                <div>Apple iPhone XS (2024)</div>
                <div class="text-gray-500">$1,199.00</div>
              </div>
              <div class="ms-auto text-center">
                <div class="fs-13px">
                  <span data-animation="number" data-value="185">0</span>
                </div>
                <div class="text-gray-500 fs-10px">sold</div>
              </div>
            </div>
            <!-- END product -->
            <!-- BEGIN product -->
            <div class="d-flex align-items-center mb-15px">
              <div class="widget-img rounded-3 me-10px bg-white p-3px w-30px">
                <div
                  class="h-100 w-100"
                  style="
                    background: url(../assets/img/product/product-10.jpg) center
                      no-repeat;
                    background-size: auto 100%;
                  "
                ></div>
              </div>
              <div class="text-truncate">
                <div>Apple iPhone XS Max (2024)</div>
                <div class="text-gray-500">$3,399</div>
              </div>
              <div class="ms-auto text-center">
                <div class="fs-13px">
                  <span data-animation="number" data-value="129">0</span>
                </div>
                <div class="text-gray-500 fs-10px">sold</div>
              </div>
            </div>
            <!-- END product -->
            <!-- BEGIN product -->
            <div class="d-flex align-items-center mb-15px">
              <div class="widget-img rounded-3 me-10px bg-white p-3px w-30px">
                <div
                  class="h-100 w-100"
                  style="
                    background: url(../assets/img/product/product-11.jpg) center
                      no-repeat;
                    background-size: auto 100%;
                  "
                ></div>
              </div>
              <div class="text-truncate">
                <div>Huawei Y5 (2024)</div>
                <div class="text-gray-500">$99.00</div>
              </div>
              <div class="ms-auto text-center">
                <div class="fs-13px">
                  <span data-animation="number" data-value="96">0</span>
                </div>
                <div class="text-gray-500 fs-10px">sold</div>
              </div>
            </div>
            <!-- END product -->
            <!-- BEGIN product -->
            <div class="d-flex align-items-center">
              <div class="widget-img rounded-3 me-10px bg-white p-3px w-30px">
                <div
                  class="h-100 w-100"
                  style="
                    background: url(../assets/img/product/product-12.jpg) center
                      no-repeat;
                    background-size: auto 100%;
                  "
                ></div>
              </div>
              <div class="text-truncate">
                <div>Huawei Nova 4 (2024)</div>
                <div class="text-gray-500">$499.00</div>
              </div>
              <div class="ms-auto text-center">
                <div class="fs-13px">
                  <span data-animation="number" data-value="55">0</span>
                </div>
                <div class="text-gray-500 fs-10px">sold</div>
              </div>
            </div>
            <!-- END product -->
          </div>
          <!-- END card-body -->
        </div>
        <!-- END card -->
      </div>
      <!-- END col-4 -->
      <!-- BEGIN col-4 -->
      <div class="col-xl-4 col-lg-6">
        <!-- BEGIN card -->
        <div class="card border-0 mb-3 bg-gray-800 text-white">
          <!-- BEGIN card-body -->
          <div class="card-body">
            <!-- BEGIN title -->
            <div class="mb-3 text-gray-500">
              <b>MARKETING CAMPAIGN</b>
              <span class="ms-2"
                ><i
                  class="fa fa-info-circle"
                  data-bs-toggle="popover"
                  data-bs-trigger="hover"
                  data-bs-title="Marketing Campaign"
                  data-bs-placement="top"
                  data-bs-content="Campaign that run for getting more returning customers."
                ></i
              ></span>
            </div>
            <!-- END title -->
            <!-- BEGIN row -->
            <div class="row align-items-center pb-1px">
              <!-- BEGIN col-4 -->
              <div class="col-4">
                <div
                  class="h-100px d-flex align-items-center justify-content-center"
                >
                  <img src="/assets/img/svg/img-2.svg" class="mw-100 mh-100" />
                </div>
              </div>
              <!-- END col-4 -->
              <!-- BEGIN col-8 -->
              <div class="col-8">
                <div class="mb-2px text-truncate">Email Marketing Campaign</div>
                <div class="mb-2px text-gray-500 small">
                  Mon 12/6 - Sun 18/6
                </div>
                <div class="d-flex align-items-center mb-2px">
                  <div class="flex-grow-1">
                    <div
                      class="progress h-5px rounded-pill bg-white bg-opacity-10"
                    >
                      <div
                        class="progress-bar progress-bar-striped bg-indigo"
                        data-animation="width"
                        data-value="80%"
                        style="width: 0%"
                      ></div>
                    </div>
                  </div>
                  <div class="ms-2 small w-30px text-center">
                    <span data-animation="number" data-value="80">0</span>%
                  </div>
                </div>
                <div class="text-gray-500 small mb-15px text-truncate">
                  57.5% people click the email
                </div>
                <a href="#" class="btn btn-xs btn-indigo fs-10px ps-2 pe-2"
                  >View campaign</a
                >
              </div>
              <!-- END col-8 -->
            </div>
            <!-- END row -->
            <hr class="bg-white bg-opacity-20 mt-20px mb-20px" />
            <!-- BEGIN row -->
            <div class="row align-items-center">
              <!-- BEGIN col-4 -->
              <div class="col-4">
                <div
                  class="h-100px d-flex align-items-center justify-content-center"
                >
                  <img src="/assets/img/svg/img-3.svg" class="mw-100 mh-100" />
                </div>
              </div>
              <!-- END col-4 -->
              <!-- BEGIN col-8 -->
              <div class="col-8">
                <div class="mb-2px text-truncate">
                  Facebook Marketing Campaign
                </div>
                <div class="mb-2px text-gray-500 small">
                  Sat 10/6 - Sun 18/6
                </div>
                <div class="d-flex align-items-center mb-2px">
                  <div class="flex-grow-1">
                    <div
                      class="progress h-5px rounded-pill bg-white bg-opacity-10"
                    >
                      <div
                        class="progress-bar progress-bar-striped bg-warning"
                        data-animation="width"
                        data-value="60%"
                        style="width: 0%"
                      ></div>
                    </div>
                  </div>
                  <div class="ms-2 small w-30px text-center">
                    <span data-animation="number" data-value="60">0</span>%
                  </div>
                </div>
                <div class="text-gray-500 small mb-15px text-truncate">
                  +124k visitors from facebook
                </div>
                <a href="#" class="btn btn-xs btn-warning fs-10px ps-2 pe-2"
                  >View campaign</a
                >
              </div>
              <!-- END col-8 -->
            </div>
            <!-- END row -->
          </div>
          <!-- END card-body -->
        </div>
        <!-- END card -->
      </div>
      <!-- END col-4 -->
    </div>
    <!-- END row -->
  </app-layout>
</template>
