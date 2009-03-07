<?php $this->load->view('header.php') ?>
<div id="content">
		<h1><?=$this->lang->line['account_management']?></h1>
		<div id="action_menu">
			<ul>
				<li class="new_account"><a href="#" title="Create new account"><span>Create New Account</span></a></li>
				<li class="generate_voucher"><a href="#" title="Generate new account"><span>Generate New Voucher</span></a></li>
			</ul>
		</div>
		<p>Easy Hotspot is an open source software, released under GNU Public Licensced. This software is made for thoose who want make a hotspot with less configuration. In most case Easy Hotspot is run out of the box. Please notice that Easy Hotspot is not for replace for existing hotspot management. We only try to give you an alternative and we try to give a contribution to open source community.</p>
		
<table class="stripe" id="invoiceListings">
  <tbody id="invoiceRows">
    <tr>
      <th class="invNum">Invoice</th>
      <th class="dateIssued">Date Issued</th>
      <th class="clientName">Client Name</th>

      <th class="amount">Amount</th>
      <th class="status">Status</th>
    </tr>
    <tr>
      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/3" title="113">113</a></td>
      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/3" title="November 28, 2007">November 28, 2007</a></td>
      <td class="cName"><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/3" title="Marvel">Marvel</a></td>

      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/3" title="$1212.00">$1212.00</a></td>
      <td>
	  <a href="http://localhost/~vcool/bamboo/index.php/invoices/view/3" title="invoice status">open</a>      </td>
    </tr>
        <tr>
      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/2" title="112">112</a></td>
      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/2" title="November 28, 2007">November 28, 2007</a></td>

      <td class="cName"><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/2" title="Marvel">Marvel</a></td>
      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/2" title="$2112.00">$2112.00</a></td>
      <td>
	  <a href="http://localhost/~vcool/bamboo/index.php/invoices/view/2" title="invoice status">open</a>      </td>
    </tr>
        <tr>
      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/1" title="111">111</a></td>

      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/1" title="November 28, 2007">November 28, 2007</a></td>
      <td class="cName"><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/1" title="Marvel">Marvel</a></td>
      <td><a href="http://localhost/~vcool/bamboo/index.php/invoices/view/1" title="$212.00">$212.00</a></td>
      <td>
	  <a href="http://localhost/~vcool/bamboo/index.php/invoices/view/1" title="invoice status">open</a>      </td>
    </tr>

      </tbody>
</table>

	</div>

<?php $this->load->view('footer')?>

