<?php

?>
                        <li>
                            <a href="."><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
<?php
switch ($_SESSION['level']) {
                    case 'Admin':
?>                  
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Jabatan<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=jabatan&act=ubah">Tambah Jabatan</a>
                                </li>
                                <li>
                                    <a href="?p=jabatan">Data Jabatan</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> Users<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=user&act=ubah">Tambah User</a>
                                </li>
                                <li>
                                    <a href="?p=user">Data User</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> Penggajian<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=gaji_input">Input Gaji Bulanan</a>
                                </li>
                                <li>
                                    <a href="?p=thr_input">Input Gaji THR</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> Laporan & Grafik<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=laporan_gaji">Laporan Gaji Bulanan</a>
                                </li>
                                <li>
                                    <a href="?p=grafik_gaji">Grafik Gaji Bulanan</a>
                                </li>
                                <li>
                                    <a href="?p=laporan_thr">Laporan THR</a>
                                </li>
                                <li>
                                    <a href="?p=grafik_thr">Grafik THR</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?p=kwitansi"><i class="fa fa-dollar fa-fw"></i> Cetak Slip Gaji</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bug fa-fw"></i> Debugging!!<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="input_truncate.php" title="Akan menghapus tabel Absen, Hitung, dan Gaji" alt="Akan menghapus tabel Absen, Hitung, dan Gaji">No.1 > Hapus Tabel</a>
                                </li>
                                <!--
                                <li>
                                    <a href="input_pegawai.php">No.2 > Input Users</a>
                                </li>
                                -->
                                <li>
                                    <a href="input_gaji.php" title="Simulasi input gaji" alt="Simulasi input gaji">No.2 > Input Absen</a>
                                </li>
                            </ul>
                        </li>
<?php                       
                        break;
                    case 'Direktur':
?>                  
                        <li>
                            <a href="#"><i class="fa fa-dollar fa-fw"></i> Laporan & Grafik<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="?p=laporan_gaji">Laporan Gaji Bulanan</a>
                                </li>
                                <li>
                                    <a href="?p=grafik_gaji">Grafik Gaji Bulanan</a>
                                </li>
                                <li>
                                    <a href="?p=laporan_thr">Laporan THR</a>
                                </li>
                                <li>
                                    <a href="?p=grafik_thr">Grafik THR</a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="?p=kwitansi"><i class="fa fa-dollar fa-fw"></i> Cetak Slip Gaji</a>
                        </li>
<?php                       
                        break;
                    case 'Pegawai':
?>                  
                        <li>
                            <a href="?p=kwitansi"><i class="fa fa-dollar fa-fw"></i> Cetak Slip Gaji</a>
                        </li>
<?php                       
                        break;
                	
                	default:
                		# code...
                		break;
                        }
?>                                                
                        <!--li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                        </li-->