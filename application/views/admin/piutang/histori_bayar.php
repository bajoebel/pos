<table class="table table-bordered">
                        <thead class="bg-green">
                            <th>#</th>
                            <th>TANGGAL</th>
                            <th class="text-right">JUMLAH BAYAR</th>
                        </thead>
                        <tbody id="data">
                            <?php 
                            $no=0;
                            $jml_bayar=0;
                            foreach ($data as $d) {
                                $no++;
                                $jml_bayar+=$d->terima_jumlah;
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $d->terima_tgl ?></td>
                                    <td class="text-right">Rp. <?php echo $d->terima_jumlah ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <tbody class="bg-green">
                            <tr>
                                <th colspan="2">TOTAL</th>
                                <th class="text-right">Rp. <?php echo $jml_bayar; ?></th>
                            </tr>
                        </tbody>
                    </table>