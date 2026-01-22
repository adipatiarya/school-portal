// Response wrapper generic
export type DashboardServiceResponse<T> = {
  data: T;
};

// Parameter type
export type DashboardServiceParam = {
  year: string;
};

// Struktur chart
export interface StudentAbsentChart {
  label: string[];
  data: number[];
}

// Struktur detail dashboard
export interface DashboardDetail {
  studentAbsentChart: StudentAbsentChart;
}

export class DashboardService {
  static async detail(
    param: DashboardServiceParam
  ): Promise<DashboardServiceResponse<DashboardDetail>> {
    return new Promise((resolve) => {
      setTimeout(() => {
        resolve({
          data: {
            studentAbsentChart: {
              label:
                param.year === "ALL"
                  ? ["2021", "2022", "2023", "2024", "2025", "2026"]
                  : [
                      "JAN",
                      "FEB",
                      "MAR",
                      "APR",
                      "MAY",
                      "JUN",
                      "JUL",
                      "AGS",
                      "SEP",
                      "OKT",
                      "NOV",
                      "DES",
                    ],
              data:
                param.year === "ALL"
                  ? [20, 30, 40, 50, 80, 100]
                  : [20, 30, 40, 50, 80, 100, 80, 30, 40, 50, 80, 100], // nanti diisi dari API / DB
            },
          },
        });
      }, 1000);
    });
  }
}
