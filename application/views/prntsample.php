<script>
    /* ------------------------------------------------------------------------------
 *
 *  # Echarts - Line charts
 *
 *  Demo JS code for echarts_lines.html page
 *
 * ---------------------------------------------------------------------------- */


    // Configure examples
    // ------------------------------

    document.addEventListener('DOMContentLoaded', function () {

        var line_chart = c3.generate({
            bindto: '#c3-line-chart',
            point: {
                r: 4
            },
            size: {height: 400},
            color: {
                pattern: ['#4CAF50', '#F4511E', '#1E88E5']
            },
            data: {
                columns: [

                    <?php
                    $allestates = $this->db->query("select distinct(estate) from bookings order by estate desc ")->result_array();
                    if (count($allestates) > 0) {
                        foreach ($allestates as $singleestate) {
                            $thisestate = $singleestate['estate'];
                            $fetchestate = $this->db->query("select estatename from tbl_estates where id='$thisestate'")->row();
                            $thisname = $fetchestate->estatename;
                            $data = '[' . '\'' . ucwords($thisname) . '\'' . ',';
                            $allpayments = $this->db->query("select amountpaid from bookings where estate='$thisestate'")->result_array();
                            foreach ($allpayments as $payments):
                                $data .= $payments['amountpaid'] . ',';
                            endforeach;
                            $data .= '],';
                        }
                        echo $data;
                    }
                    ?>
                ],
                type: 'spline'
            },
            grid: {
                y: {
                    show: true
                }
            }
        });


        // Resize chart on sidebar width change
        $(".sidebar-control").on('click', function () {
            line_chart.resize();
        });
    });
</script>