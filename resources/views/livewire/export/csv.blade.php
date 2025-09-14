<div>
    <section class="section custom-section">
        <div class="section-header">
            <h1>Export CSV</h1>
            <div class="ml-auto tw-flex tw-space-x-2">
                <select wire:model.live='filter_parameter' id='filter_parameter'
                    class='tw-w-full tw-border tw-border-gray-300 tw-rounded-full tw-text-sm'>
                    <option value='Temperature'>Temperature</option>
                    <option value='Voltage'>Voltage</option>
                    <option value='Current'>Current</option>
                </select>
            </div>
        </div>
        <div class="section-body">
            <div class="card tw-text-center">
                <div class="card-body">
                    <div>
                        <p class="tw-tracking-wider tw-text-[#34395e] tw-text-base tw-font-semibold">
                            {{ \Carbon\Carbon::parse(str_replace('T',' ', $start_date))->format('d F Y H:i:s') }}
                            <span class="tw-text-gray-400 tw-font-normal">s/d</span>
                            {{ \Carbon\Carbon::parse(str_replace('T',' ', $end_date))->format('d F Y H:i:s') }}
                        </p>

                        <div class="tw-inline-flex tw-space-x-2 tw-items-center tw-mt-3">
                            <input wire:model.live="start_date" type="datetime-local" class="form-control">
                            <button wire:click.prevent="refreshToday()"
                                class="btn btn-primary tw-rounded-full tw-w-1/2">
                                <i class="fas fa-sync"></i>
                            </button>
                            <input wire:model.live="end_date" type="datetime-local" class="form-control">
                        </div>
                    </div>

                    <a href="{{ route('temperatures.export', ['start' => $start_date, 'end' => $end_date]) }}"
                        class="btn btn-danger tw-mt-4" target="_BLANK">
                        <i class="fas fa-file-csv"></i> Export CSV
                    </a>
                </div>
            </div>
            <div class="card">
                <h3>Table {{ $filter_parameter }}</h3>
                <div class="card-body">
                    <div class="show-entries">
                        <p class="show-entries-show">Show</p>
                        <select wire:model.live="lengthData" id="length-data">
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                            <option value="250">250</option>
                            <option value="500">500</option>
                        </select>
                        <p class="show-entries-entries">Entries</p>
                    </div>
                    <div class="search-column">
                        <p>Search: </p><input type="search" wire:model.live.debounce.750ms="searchTerm" id="search-data"
                            placeholder="Search here..." class="form-control" value="">
                    </div>
                    <div class="table-responsive tw-max-h-96">
                        <table class="tw-table-auto">
                            <thead class="tw-sticky tw-top-0">
                                <tr>
                                    <th rowspan="2" width="6%" class="text-center">No</th>
                                    <th rowspan="2" class="tw-whitespace-nowrap tw-text-center">Timestamps</th>
                                    <th class="tw-text-center" colspan="12">Node</th>
                                </tr>
                                <tr class="tw-text-gray-700">
                                    <th class="tw-whitespace-nowrap tw-text-center">A</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Bh</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Bc</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">C</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Dh</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Dc</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Fh</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Fc</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">G</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Hh</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">Hc</th>
                                    <th class="tw-whitespace-nowrap tw-text-center">I</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $row)
                                <tr>
                                    <td class="text-center">{{ $loop->index + 1 }}</td>
                                    <td>{{ $row->created_at }}</td>
                                    @if ($filter_parameter === 'Temperature')
                                    <td>{{ $row->temp_a }}</td>
                                    <td>{{ $row->temp_bh }}</td>
                                    <td>{{ $row->temp_bc }}</td>
                                    <td>{{ $row->temp_c }}</td>
                                    <td>{{ $row->temp_dh }}</td>
                                    <td>{{ $row->temp_dc }}</td>
                                    <td>{{ $row->temp_fh }}</td>
                                    <td>{{ $row->temp_fc }}</td>
                                    <td>{{ $row->temp_g }}</td>
                                    <td>{{ $row->temp_hh }}</td>
                                    <td>{{ $row->temp_hc }}</td>
                                    <td>{{ $row->temp_i }}</td>
                                    @elseif ($filter_parameter === 'Voltage')
                                    <td>{{ $row->volt_a }}</td>
                                    <td>{{ $row->volt_bh }}</td>
                                    <td>{{ $row->volt_bc }}</td>
                                    <td>{{ $row->volt_c }}</td>
                                    <td>{{ $row->volt_dh }}</td>
                                    <td>{{ $row->volt_dc }}</td>
                                    <td>{{ $row->volt_fh }}</td>
                                    <td>{{ $row->volt_fc }}</td>
                                    <td>{{ $row->volt_g }}</td>
                                    <td>{{ $row->volt_hh }}</td>
                                    <td>{{ $row->volt_hc }}</td>
                                    <td>{{ $row->volt_i }}</td>
                                    @elseif ($filter_parameter === 'Current')
                                    <td>{{ $row->curr_a }}</td>
                                    <td>{{ $row->curr_bh }}</td>
                                    <td>{{ $row->curr_bc }}</td>
                                    <td>{{ $row->curr_c }}</td>
                                    <td>{{ $row->curr_dh }}</td>
                                    <td>{{ $row->curr_dc }}</td>
                                    <td>{{ $row->curr_fh }}</td>
                                    <td>{{ $row->curr_fc }}</td>
                                    <td>{{ $row->curr_g }}</td>
                                    <td>{{ $row->curr_hh }}</td>
                                    <td>{{ $row->curr_hc }}</td>
                                    <td>{{ $row->curr_i }}</td>
                                    @endif
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="20" class="text-center">Not data available in the table</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5 px-3">
                        {{ $data->links() }}
                    </div>
                </div>
            </div>
    </section>
</div>
