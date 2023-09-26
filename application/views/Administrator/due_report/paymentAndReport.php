<?php
$branchID = $this->session->userdata('BRANCHid');
$PamentID = $this->session->userdata('PamentID');
$SCP = $this->db->query("SELECT tbl_customer_payment.*, tbl_customer.* FROM tbl_customer_payment LEFT JOIN tbl_customer ON tbl_customer.Customer_SlNo = tbl_customer_payment.CPayment_customerID WHERE tbl_customer_payment.CPayment_id = '$PamentID'");
$CPROW = $SCP->row();
$CUSID = $CPROW->CPayment_customerID;
$paid = $CPROW->CPayment_amount;
$type = $CPROW->CPayment_TransactionType;


$Custid = $CPROW->CPayment_customerID;

$prevdueAmont = $CPROW->CPayment_previous_due;
$totalDue = $type == 'CR' ? $prevdueAmont - ($CPROW->CPayment_amount  + $CPROW->CPayment_commission): $prevdueAmont + $CPROW->CPayment_amount + $CPROW->CPayment_commission;

?>

<div class="content_scroll" style="width: 850px; ">
<a  id="printIcon" style="cursor:pointer"> <i class="fa fa-print" style="font-size:24px;color:green"></i> Print</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="<?php echo base_url();?>customerPaymentPage" title="" class="buttonAshiqe">Go Back</a>
    <div id="reportContent">
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-12">
                <h6 style="background:#ddd; text-align: center; font-size: 18px; font-weight: 900; padding: 5px; color: #bd4700;">Customer Payment Invoice</h6>
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-12">
                <table style="width: 100%;">
                    <tr>
                        <td style="font-size: 13px; font-weight: 600;"> TR. Id: <?php echo $CPROW->CPayment_invoice; ?></td>
                    </tr>
                    <tr>
                        <td style="font-size: 13px; font-weight: 600; ">TR. Date: <?php echo $CPROW->CPayment_date; ?> </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size: 13px; font-weight: 600; ">Name : <?php echo $CPROW->Customer_Name; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" style="font-size: 13px; font-weight: 600; ">Phone No. : <?php echo $CPROW->Customer_Mobile; ?></td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-12">
                <table class="border" cellspacing="0" cellpadding="0" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="font-size: 14px; font-weight: 700;text-align:center;">Sl No</th>
                            <th style="font-size: 14px; font-weight: 700;text-align:center;">Description</th>
                            <th style="font-size: 14px; font-weight: 700;text-align:center;">Recieved</th>
                            <th style="font-size: 14px; font-weight: 700;text-align:center;">Payment</th>
                            <th style="font-size: 14px; font-weight: 700;text-align:center;">Commission</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        <td style="text-align: center;">01</td>
                        <td><?php echo $CPROW->CPayment_notes; ?></td>
                        <td style="text-align:right;"><?php if($type == 'CR'): echo number_format($CPROW->CPayment_amount, 2); else: echo '00.00'; endif; ?></td>
                        <td style="text-align:right;"><?php if($type == 'CP'): echo number_format($CPROW->CPayment_amount, 2); else: echo '00.00'; endif; ?></td>
                        <td style="text-align:right;"><?php echo number_format($CPROW->CPayment_commission, 2) ?></td>
                        </tr>
                        <tr>
                            <th colspan="2" style="font-size: 14px; font-weight: 700; text-align: right;">Total:</th>
                            <th style="font-size: 13px; font-weight: 700;text-align:right;"><?php if($type == 'CR'): echo number_format($CPROW->CPayment_amount, 2); else: echo '00.00'; endif; ?></th>
                            <th style="font-size: 13px; font-weight: 700;text-align:right;"><?php if($type == 'CP'): echo number_format($CPROW->CPayment_amount, 2); else: echo '00.00'; endif; ?></th>
                            <td style="font-size: 13px; font-weight: 700;text-align:right;"><?php echo number_format($CPROW->CPayment_commission, 2) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-12">
                <!-- <h6 style=" font-size: 12px; font-weight: 600;">Paid (In Word): <?php echo convertNumberToWord($CPROW->CPayment_amount);?></h6> -->
                <h6 style=" font-size: 12px; font-weight: 600;">Paid (In Word): <span class="convertNumber"></span></h6>
            </div>
        </div>
        <div class="row" style="margin-bottom: 20px;">
            <div class="col-xs-12 text-left;">
                <table style="width: 25%;float:left;">
                    <tr>
                        <td  style="font-size: 13px; font-weight: 600; ">Previous Due : </td>
                        <td  style="font-size: 13px; font-weight: 600; text-align: right; "> <?php echo number_format($prevdueAmont, 2); ?></td>
                    </tr>
                    <tr>
                        <td  style="font-size: 13px; font-weight: 600; ">Paid Amount : </td>
                        <td  style="font-size: 13px; font-weight: 600; text-align: right; "><?php echo number_format($CPROW->CPayment_amount, 2); ?></td>
                    </tr>
                    <tr>
                        <td  style="font-size: 13px; font-weight: 600; border-bottom: 2px solid #000; ">Com. Amount : </td>
                        <td  style="font-size: 13px; font-weight: 600; border-bottom: 2px solid #000; text-align: right; "><?php echo number_format($CPROW->CPayment_commission, 2); ?></td>
                    </tr>
                    <tr>
                        <td style="font-size: 13px; font-weight: 600; ">Current Due : </td>
                        <td style="font-size: 13px; font-weight: 600; text-align: right; "><?php echo number_format($totalDue, 2); ?></td>
                    </tr>
                </table>
                <div style="float:right;text-decoration: overline;">
                    <strong>Autorizied signature</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 

  function convertNumberToWord($num = false){
      $num = str_replace(array(',', ' '), '' , trim($num));
      if(! $num) {
          return false;
      }
      $num = (int) $num;
      $words = array();
      $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
          'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
      );
      $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
      $list3 = array('', 'thousand', 'milion', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
          'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
          'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
      );
      $num_length = strlen($num);
      return $levels = (int) (($num_length + 2) / 3);
      $max_length = $levels * 3;
      $num = substr('00' . $num, -$max_length);
      $num_levels = str_split($num, 3);
      for ($i = 0; $i < count($num_levels); $i++) {
          $levels--;
          $hundreds = (int) ($num_levels[$i] / 100);
          $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ( $hundreds == 1 ? '' : 's' ) . ' ' : '');
          $tens = (int) ($num_levels[$i] % 100);
          $singles = '';
          if ( $tens < 20 ) {
              $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
          } else {
              $tens = (int)($tens / 10);
              $tens = ' ' . $list2[$tens] . ' ';
              $singles = (int) ($num_levels[$i] % 10);
              $singles = ' ' . $list1[$singles] . ' ';
          }
          $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
      } //end for loop
      $commas = count($words);
      if ($commas > 1) {
          $commas = $commas - 1;
      }
      $inword = implode(' ', $words) ."Taka Only";
    return strtoupper($inword);
  }
  
?>

<script>
    let printIcon = document.querySelector('#printIcon');
    printIcon.addEventListener('click', () => {
        event.preventDefault();
        print();
    })
    async function print(){
        let reportContent = `
            <div class="container">
                ${document.querySelector('#reportContent').innerHTML}
            </div>
        `;

        var reportWindow = window.open('', 'PRINT', `height=${screen.height}, width=${screen.width}`);
        reportWindow.document.write(`
            <?php $this->load->view('Administrator/reports/reportHeader.php');?>
        `);

        reportWindow.document.head.innerHTML += `<link href="<?php echo base_url()?>assets/css/prints.css" rel="stylesheet" />`;
        reportWindow.document.body.innerHTML += reportContent;

        reportWindow.focus();
        await new Promise(resolve => setTimeout(resolve, 1000));
        reportWindow.print();
        reportWindow.close();
    }

    function convertNumberToWords(amountToWord) {
      var words = new Array();
      words[0] = "";
      words[1] = "One";
      words[2] = "Two";
      words[3] = "Three";
      words[4] = "Four";
      words[5] = "Five";
      words[6] = "Six";
      words[7] = "Seven";
      words[8] = "Eight";
      words[9] = "Nine";
      words[10] = "Ten";
      words[11] = "Eleven";
      words[12] = "Twelve";
      words[13] = "Thirteen";
      words[14] = "Fourteen";
      words[15] = "Fifteen";
      words[16] = "Sixteen";
      words[17] = "Seventeen";
      words[18] = "Eighteen";
      words[19] = "Nineteen";
      words[20] = "Twenty";
      words[30] = "Thirty";
      words[40] = "Forty";
      words[50] = "Fifty";
      words[60] = "Sixty";
      words[70] = "Seventy";
      words[80] = "Eighty";
      words[90] = "Ninety";
      amount = amountToWord == null ? "0.00" : amountToWord.toString();
      var atemp = amount.split(".");
      var number = atemp[0].split(",").join("");
      var n_length = number.length;
      var words_string = "";
      if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
          received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
          n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
          if (i == 0 || i == 2 || i == 4 || i == 7) {
            if (n_array[i] == 1) {
              n_array[j] = 10 + parseInt(n_array[j]);
              n_array[i] = 0;
            }
          }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
          if (i == 0 || i == 2 || i == 4 || i == 7) {
            value = n_array[i] * 10;
          } else {
            value = n_array[i];
          }
          if (value != 0) {
            words_string += words[value] + " ";
          }
          if (
            (i == 1 && value != 0) ||
            (i == 0 && value != 0 && n_array[i + 1] == 0)
          ) {
            words_string += "Crores ";
          }
          if (
            (i == 3 && value != 0) ||
            (i == 2 && value != 0 && n_array[i + 1] == 0)
          ) {
            words_string += "Lakhs ";
          }
          if (
            (i == 5 && value != 0) ||
            (i == 4 && value != 0 && n_array[i + 1] == 0)
          ) {
            words_string += "Thousand ";
          }
          if (
            i == 6 &&
            value != 0 &&
            n_array[i + 1] != 0 &&
            n_array[i + 2] != 0
          ) {
            words_string += "Hundred and ";
          } else if (i == 6 && value != 0) {
            words_string += "Hundred ";
          }
        }
        words_string = words_string.split("  ").join(" ");
      }
    //   return words_string + " only";

      $('.convertNumber').text(words_string + " only");
    }

    convertNumberToWords("<?php echo $CPROW->CPayment_amount ;?>")
</script>