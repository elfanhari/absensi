@foreach ($siswa as $row)
                      <tr class="border-dark">
                        <td class="border-dark">{{ $loop->iteration }}</td>
                        <td class="border-dark">{{ $row->nis }}</td>
                        <td class="border-dark">{{ $row->name }}</td>
                        <td class="border-dark" style="text-align: center">{{ $row->jk }}</td>
                        @php
                             $H = $absen->where('siswa_id', $row->id)
                                        ->whereIn('keterangan', ['H'])
                                        ->where('tanggal', '>=', $months[0])
                                        ->where('tanggal', '<=', end($months))
                                        ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                        ->count();

                             $S = $absen->where('siswa_id', $row->id)
                                        ->whereIn('keterangan', ['S'])
                                        ->where('tanggal', '>=', $months[0])
                                        ->where('tanggal', '<=', end($months))
                                        ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                        ->count();

                             $I = $absen->where('siswa_id', $row->id)
                                        ->whereIn('keterangan', ['I'])
                                        ->where('tanggal', '>=', $months[0])
                                        ->where('tanggal', '<=', end($months))
                                        ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                        ->count();

                             $A = $absen->where('siswa_id', $row->id)
                                        ->whereIn('keterangan', ['A'])
                                        ->where('tanggal', '>=', $months[0])
                                        ->where('tanggal', '<=', end($months))
                                        ->whereNotIn('tanggal', $libur->pluck('tgl'))
                                        ->count();
                        @endphp

                        <td class="border-dark" style="text-align: center">{{ $H > 0 ? $H : '' }}</td>
                        <td class="border-dark" style="text-align: center">{{ $S > 0 ? $S : '' }}</td>
                        <td class="border-dark" style="text-align: center">{{ $I > 0 ? $I : '' }}</td>
                        <td class="border-dark" style="text-align: center">{{ $A > 0 ? $A : '' }}</td>
                      </tr>
  @endforeach
