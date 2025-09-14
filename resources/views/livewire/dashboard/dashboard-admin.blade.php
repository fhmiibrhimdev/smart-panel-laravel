<div>
    <div
        class="tw-flex tw-justify-between tw-text-2xl tw-px-6 tw-py-6 tw-bg-slate-900 tw-bg-opacity-[70%] tw-shadow-md tw-shadow-gray-950">
        <div class="tw-font-semibold">
            <p class="tw-text-yellow-400 hover:tw-text-yellow-300 ">SMART SOLAR PANEL</p>
        </div>
        <div class="tw-flex tw-items-center tw-space-x-5 tw-text-xl tw-font-semibold">
            <p id="waktu-indonesia"></p>
            <script>
                function updateWaktu() {
                    const waktu = new Date();
                    const hari = waktu.toLocaleDateString('id-ID', {
                        weekday: 'short'
                    });
                    const tanggal = waktu.getDate();
                    const bulan = waktu.toLocaleDateString('id-ID', {
                        month: 'short'
                    });
                    const tahun = waktu.getFullYear().toString().slice(-2);
                    const jam = waktu.getHours().toString().padStart(2, '0');
                    const menit = waktu.getMinutes().toString().padStart(2, '0');
                    const detik = waktu.getSeconds().toString().padStart(2, '0');
                    const waktuStr = `${hari}, ${tanggal} ${bulan} '${tahun} ${jam}:${menit}:${detik}`;
                    document.getElementById('waktu-indonesia').textContent = waktuStr;
                }
                setInterval(updateWaktu, 1000);
                updateWaktu();

            </script>
            <p class="tw-text-cyan-400">DASHBOARD</p>
            <a href="{{ url('/export/csv') }}" class="">EXPORT CSV</a>
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-3 tw-px-4 tw-gap-4 tw-mt-5">
        <div class="tw-col-span-2">
            <div class="tw-bg-white/5 tw-backdrop-blur-md tw-rounded-xl tw-px-6 tw-py-2 tw-relative tw-shadow-lg">
                <div class="tw-text-center">
                    <p class="tw-text-cyan-400 tw-font-semibold tw-text-4xl tw-mt-8">REALTIME MONITORING</p>
                </div>
                <div class="tw-grid tw-grid-cols-3 tw-gap-4 tw-text-center">
                    <div class="tw-col-span-1">
                        <div class="tw-bg-white/5 tw-backdrop-blur-md tw-rounded-lg tw-px-2 tw-py-2 tw-mt-10">
                            <h2 class="tw-font-semibold tw-text-2xl tw-mb-4 tw-mt-2 tw-tracking-tighter">TEMPERATURE
                            </h2>
                            <div class="tw-grid tw-grid-cols-1 tw-gap-x-2 tw-gap-y-2">
                                <div class="tw-text-left">
                                    <div
                                        class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node A: </p>
                                        <p><span id="temp_a">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Bh: </p>
                                        <p><span id="temp_bh">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Bc: </p>
                                        <p><span id="temp_bc">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node C: </p>
                                        <p><span id="temp_c">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Dh: </p>
                                        <p><span id="temp_dh">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Dc: </p>
                                        <p><span id="temp_dc">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Fh: </p>
                                        <p><span id="temp_fh">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Fc: </p>
                                        <p><span id="temp_fc">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node G: </p>
                                        <p><span id="temp_g">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Hh: </p>
                                        <p><span id="temp_hh">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node Hc: </p>
                                        <p><span id="temp_hc">...</span>°C</p>
                                    </div>
                                    <div
                                        class="tw-bg-slate-900 tw-mt-1.5 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                        <p>Node I: </p>
                                        <p><span id="temp_i">...</span>°C</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tw-col-span-1 flex tw-items-center tw-justify-center">
                        <img src="{{ asset('assets/images/one-panel-6x12-v2-removebg.png') }}"
                            class="tw-w-full -tw-mb-8" alt="">
                    </div>
                    <div class="tw-col-span-1">
                        <div
                            class="tw-bg-white/5 tw-backdrop-blur-md tw-rounded-lg tw-px-2 tw-py-2 tw-relative tw-mt-10">
                            <h2 class="tw-font-semibold tw-text-2xl tw-mb-4 tw-mt-2 tw-tracking-tighter">VOLTAGE &
                                CURRENT
                            </h2>
                            <div class="tw-grid tw-grid-cols-2 tw-gap-x-4 tw-gap-y-4">
                                <div class="tw-col-span-1">
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Voltage 1 :</p>
                                            <p>... V</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Voltage 2 :</p>
                                            <p>... V</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Voltage 3 :</p>
                                            <p>... V</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Voltage 4 :</p>
                                            <p>... V</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Voltage 5 :</p>
                                            <p>... V</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="tw-col-span-1">
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Current 1 :</p>
                                            <p>... mA</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Current 2 :</p>
                                            <p>... mA</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Current 3 :</p>
                                            <p>... mA</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Current 4 :</p>
                                            <p>... mA</p>
                                        </div>
                                    </div>
                                    <div class="tw-text-left tw-mt-2">
                                        <div
                                            class="tw-bg-slate-900 tw-backdrop-blur-md tw-px-2 tw-flex tw-items-center tw-justify-between tw-text-lg">
                                            <p>Current 5 :</p>
                                            <p>... mA</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tw-col-span-1">
            <div class="tw-bg-white/5 tw-backdrop-blur-md tw-rounded-xl tw-px-6 tw-py-4 tw-relative tw-shadow-lg">
                <div class="tw-flex tw-text-2xl tw-justify-between">
                    <h4>Status IoT:</h4>
                    <p id="status-iot">...</p>
                </div>
            </div>
        </div>
    </div>

    <div class="tw-grid tw-grid-cols-3 tw-px-4 tw-gap-4 tw-mt-5">
        <div class="tw-col-span-1">
            <div class="tw-bg-white/5 tw-backdrop-blur-md tw-rounded-xl tw-px-6 tw-py-4 tw-relative tw-shadow-lg">
                <div class="tw-flex tw-justify-between">
                    <h2 class="tw-font-semibold tw-text-xl tw-text-cyan-400">GRAPH TEMPERATURE</h2>
                    <select
                        class="tw-bg-transparent tw-px-2 focus:tw-bg-gray-900 tw-placeholder-gray-900 tw-py-1 tw-border tw-border-cyan-600 tw-rounded-lg">
                        <option value="all">ALL</option>
                        <option value="node-1" selected>Node 1</option>
                        <option value="node-2">Node 2</option>
                        <option value="node-3">Node 3</option>
                        <option value="node-4">Node 4</option>
                    </select>
                </div>
                <div class="tw-mt-2">
                    <canvas id="graph-temperature" height="220px"></canvas>
                </div>
            </div>
        </div>
        <div class="tw-col-span-1">
            <div class="tw-bg-white/5 tw-backdrop-blur-md tw-rounded-xl tw-px-6 tw-py-4 tw-relative tw-shadow-lg">
                <div class="tw-flex tw-justify-between">
                    <h2 class="tw-font-semibold tw-text-xl tw-text-orange-300">GRAPH VOLTAGE</h2>
                    <select
                        class="tw-bg-transparent tw-px-2 focus:tw-bg-gray-900 tw-placeholder-gray-900 tw-py-1 tw-border tw-border-orange-400 tw-rounded-lg">
                        <option value="all">ALL</option>
                        <option value="panel-1" selected>Panel 1</option>
                        <option value="panel-2">Panel 2</option>
                    </select>
                </div>
                <div class="tw-mt-2">
                    <canvas id="graph-voltage" height="220px"></canvas>
                </div>
            </div>
        </div>
        <div class="tw-col-span-1">
            <div class="tw-bg-white/5 tw-backdrop-blur-md tw-rounded-xl tw-px-6 tw-py-4 tw-relative tw-shadow-lg">
                <div class="tw-flex tw-justify-between">
                    <h2 class="tw-font-semibold tw-text-xl tw-text-red-400">GRAPH CURRENT</h2>
                    <select
                        class="tw-bg-transparent tw-px-2 focus:tw-bg-gray-900 tw-py-1 tw-border tw-border-red-500 tw-rounded-lg">
                        <option value="all">ALL</option>
                        <option value="panel-1" selected>Panel 1</option>
                        <option value="panel-2">Panel 2</option>
                    </select>
                </div>
                <div class="tw-mt-2">
                    <canvas id="graph-current" height="220px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
