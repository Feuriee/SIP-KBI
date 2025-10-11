import React from "react";
import LayoutOwner from "@/layouts/LayoutOwner";
import {
  LineChart,
  Line,
  XAxis,
  YAxis,
  CartesianGrid,
  Tooltip,
  ResponsiveContainer,
  BarChart,
  Bar,
} from "recharts";

const DashboardOwner: React.FC = () => {
  // Data dummy untuk chart
  const dataKeuangan = [
    { bulan: "Jan", pendapatan: 4000 },
    { bulan: "Feb", pendapatan: 3000 },
    { bulan: "Mar", pendapatan: 5000 },
    { bulan: "Apr", pendapatan: 4500 },
    { bulan: "Mei", pendapatan: 6000 },
  ];

  const dataKolam = [
    { bulan: "Jan", stok: 1200 },
    { bulan: "Feb", stok: 1150 },
    { bulan: "Mar", stok: 1300 },
    { bulan: "Apr", stok: 1100 },
    { bulan: "Mei", stok: 1400 },
  ];

  return (
    <LayoutOwner>
      <div className="p-6 bg-white rounded-xl shadow-sm min-h-screen">
        {/* Header Section */}
        <h1 className="text-2xl font-bold text-gray-900 mb-8">
          Dashboard Overview
        </h1>

        {/* Laporan Keuangan */}
        <section className="mb-10">
          <h2 className="text-lg font-semibold mb-4">Laporan Keuangan</h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div className="border rounded-xl p-4 text-center shadow-sm">
              <p className="text-gray-500 text-sm">Total Pendapatan</p>
              <h3 className="text-green-600 font-bold text-2xl">Rp. 20.539.000</h3>
            </div>
            <div className="border rounded-xl p-4 text-center shadow-sm">
              <p className="text-gray-500 text-sm">Total Biaya</p>
              <h3 className="text-red-600 font-bold text-2xl">Rp. 1.598.000</h3>
            </div>
            <div className="border rounded-xl p-4 text-center shadow-sm">
              <p className="text-gray-500 text-sm">Laba Bersih</p>
              <h3 className="text-green-600 font-bold text-2xl">Rp. 23.941.000</h3>
            </div>
          </div>

          {/* Chart Pendapatan */}
          <div className="border rounded-xl p-6 shadow-sm">
            <h3 className="font-semibold text-gray-800 mb-4">
              Chart Pendapatan
            </h3>
            <ResponsiveContainer width="100%" height={300}>
              <LineChart data={dataKeuangan}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="bulan" />
                <YAxis />
                <Tooltip />
                <Line
                  type="monotone"
                  dataKey="pendapatan"
                  stroke="#16a34a"
                  strokeWidth={3}
                  dot={{ r: 4 }}
                />
              </LineChart>
            </ResponsiveContainer>
          </div>
        </section>

        {/* Laporan Kolam */}
        <section>
          <h2 className="text-lg font-semibold mb-4">Laporan Kolam</h2>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div className="border rounded-xl p-4 text-center shadow-sm">
              <p className="text-gray-500 text-sm">Total Stok Ikan</p>
              <h3 className="text-green-600 font-bold text-2xl">41.0K</h3>
            </div>
            <div className="border rounded-xl p-4 text-center shadow-sm">
              <p className="text-gray-500 text-sm">Total Panen (6 bulan)</p>
              <h3 className="text-green-600 font-bold text-2xl">19.3K kg</h3>
            </div>
            <div className="border rounded-xl p-4 text-center shadow-sm">
              <p className="text-gray-500 text-sm">Persentase Pemberian Pakan</p>
              <h3 className="text-green-600 font-bold text-2xl">92%</h3>
            </div>
          </div>

          {/* Chart Stok Ikan */}
          <div className="border rounded-xl p-6 shadow-sm">
            <h3 className="font-semibold text-gray-800 mb-4">Chart Stok Ikan</h3>
            <ResponsiveContainer width="100%" height={300}>
              <BarChart data={dataKolam}>
                <CartesianGrid strokeDasharray="3 3" />
                <XAxis dataKey="bulan" />
                <YAxis />
                <Tooltip />
                <Bar dataKey="stok" fill="#3b82f6" barSize={40} />
              </BarChart>
            </ResponsiveContainer>
          </div>
        </section>
      </div>
    </LayoutOwner>
  );
};

export default DashboardOwner;
