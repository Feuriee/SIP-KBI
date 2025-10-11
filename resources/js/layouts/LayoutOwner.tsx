import React from "react";
import { LogOut } from "lucide-react";

interface LayoutProps {
  children: React.ReactNode;
}

const LayoutOwner: React.FC<LayoutProps> = ({ children }) => {
  return (
    <div className="min-h-screen bg-gray-100 text-gray-900">
      {/* Navbar */}
      <header className="flex justify-between items-center bg-white border-b px-8 py-4 shadow-sm fixed top-0 left-0 w-full z-10">
        {/* Kiri: Logo & Nama Sistem */}
        <div className="flex items-center gap-3">
          <div className="bg-blue-600 w-9 h-9 rounded-lg" />
          <div>
            <h1 className="text-lg font-bold text-gray-900 cursor-pointer hover:text-blue-600 transition">
              SIP-KIB
            </h1>
            <p className="text-sm text-gray-500 -mt-1">
              Sistem Informasi Pengelolaan
            </p>
          </div>
        </div>

        {/* Kanan: Profil Owner */}
        <div className="flex items-center gap-6">
          <div className="flex items-center gap-3">
            <div className="w-10 h-10 rounded-full bg-gray-300" />
            <div>
              <p className="font-semibold text-gray-900">Rusman Efendi</p>
              <p className="text-sm text-gray-500">Pemilik</p>
            </div>
          </div>
          <button className="flex items-center gap-2 border px-3 py-1.5 rounded-md hover:bg-gray-100 transition">
            <LogOut size={18} />
            <span>Logout</span>
          </button>
        </div>
      </header>

      {/* Konten utama */}
      <main className="pt-24 px-4 md:px-8">{children}</main>
    </div>
  );
};

export default LayoutOwner;
    