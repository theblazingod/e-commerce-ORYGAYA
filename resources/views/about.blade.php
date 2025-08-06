@extends('layouts.app')

@section('title', __('general.About Us'))

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-8 text-gray-900">
                <!-- Judul Utama -->
                <h1 class="text-4xl font-bold mb-3 text-center">Tentang ORYGAYA</h1>
<p class="text-center text-m text-gray-600 mb-10 font-semibold">
    Platform e-commerce lokal yang tumbuh dari semangat rumahan, kini hadir untuk melayani Anda dengan kualitas dan dedikasi terbaik.</p>

<!-- Our Story -->
<div class="mb-10">
    <div class="flex items-center mb-2">
<div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25"></path>
                            </svg>
                        </div>
    <h2 class="text-2xl font-bold text-black">Kisah Kami</h2>
                    </div>
    <p class="text-m text-gray-700 leading-relaxed text-left ml-16">
ORYGAYA berdiri pada Oktober 1999 sebagai usaha rumahan yang berfokus pada penjualan produk fashion berkualitas dengan harga terjangkau. Berawal dari semangat keluarga untuk menghadirkan produk fashion yang stylish dan terjangkau, ORYGAYA kini berkembang menjadi platform e-commerce lokal yang melayani pelanggan di Indonesia.    </p>
    <p class="text-m text-gray-700 leading-relaxed mt-4 text left ml-16">
        Dengan semangat kreatif dan komitmen terhadap kualitas, kami terus tumbuh mengikuti perkembangan zaman, menghadirkan pengalaman belanja online yang mudah, aman, dan memuaskan.
    </p>
</div>

<!-- Our Vision -->
<div class="mb-10">
    <div class="flex items-center mb-2">
<div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
            <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </div>
    <h2 class="text-2xl font-bold text-black">Visi Kami</h2>
                    </div>
    <p class="text-m text-gray-700 leading-relaxed text-left ml-16">
        Menjadi platform e-commerce lokal terpercaya yang dikenal luas karena kualitas produk, pelayanan pelanggan yang unggul, dan kontribusi positif terhadap pertumbuhan UMKM serta industri kreatif di Indonesia.
    </p>
</div>

<!-- Our Mission -->
    <div class="mb-10">
    <div class="flex items-center mb-2">
<div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>
                        </div>
    <h2 class="text-2xl font-bold text-black">Misi Kami</h2>
                    </div>
    <ul class="list-disc list-inside text-m text-gray-700 leading-relaxed space-y-1 ml-16">
        <li>Menyediakan produk fashion dan gaya hidup yang berkualitas dengan harga kompetitif.</li>
        <li>Memberikan pengalaman belanja online yang nyaman, cepat, dan aman.</li>
        <li>Terus berinovasi dalam teknologi dan layanan demi kepuasan pelanggan.</li>
        <li>Menjadi bagian dari perubahan positif dalam gaya hidup masyarakat Indonesia.</li>
    </ul>
</div>

<!--Our Values-->
    <div class="mb-10">
    <div class="flex items-center mb-2">
<div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center mr-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-width="2" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09ZM18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456ZM16.894 20.567 16.5 21.75l-.394-1.183a2.25 2.25 0 0 0-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 0 0 1.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 0 0 1.423 1.423l1.183.394-1.183.394a2.25 2.25 0 0 0-1.423 1.423Z" />
                            </svg>
                        </div>
    <h2 class="text-2xl font-bold text-black">Nilai Kami</h2>
                    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-gray-700 ml-14">
        @php
            $values = [
                ['title' => 'Integritas', 'desc' => 'Kami menjunjung tinggi kejujuran, transparansi, dan tanggung jawab dalam setiap aspek bisnis kami.'],
                ['title' => 'Kualitas', 'desc' => 'Kami berkomitmen menghadirkan produk yang memenuhi standar tinggi, dari bahan hingga proses produksi.'],
                ['title' => 'Kepuasan Pelanggan', 'desc' => 'Pelanggan adalah prioritas utama kami. Kami selalu siap memberikan layanan terbaik.'],
                ['title' => 'Inovasi', 'desc' => 'Kami terus mencari cara baru dan kreatif untuk meningkatkan layanan dan menghadirkan pengalaman belanja yang lebih baik.'],

            ];
        @endphp

        @foreach($values as $value)
            <div class="flex items-start gap-3 bg-blue-50 p-4 rounded-md">
                <div class="text-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mt-1" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                    </svg>
                </div>
                <div>
                    <p><strong>{{ $value['title'] }}:</strong> {{ $value['desc'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>

            </div>
        </div>
    </div>
</div>
@endsection