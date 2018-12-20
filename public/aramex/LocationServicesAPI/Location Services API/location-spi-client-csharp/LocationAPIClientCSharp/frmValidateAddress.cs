using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;

namespace LocationAPIClientCSharp
{
    public partial class frmValidateAddress : Form
    {
        public frmValidateAddress()
        {
            InitializeComponent();
        }

        private void btnSubmit_Click(object sender, EventArgs e)
        {
            LocationReference.AddressValidationRequest _Request = new LocationReference.AddressValidationRequest();
            _Request.ClientInfo = new LocationReference.ClientInfo();
            _Request.ClientInfo.AccountCountryCode = txtAccountCountryCode.Text.Trim();
            _Request.ClientInfo.AccountEntity = txtAccountEntity.Text.Trim();
            _Request.ClientInfo.AccountNumber = txtAccountNumber.Text.Trim();
            _Request.ClientInfo.AccountPin = txtAccountPin.Text.Trim();
            _Request.ClientInfo.UserName = txtUsername.Text.Trim();
            _Request.ClientInfo.Password = txtPassword.Text.Trim();
            _Request.ClientInfo.Version = txtVersion.Text.Trim();
            _Request.ClientInfo.Source = 24;

            _Request.Transaction = new LocationReference.Transaction();
            _Request.Transaction.Reference1 = "";
            _Request.Transaction.Reference2 = "";
            _Request.Transaction.Reference3 = "";
            _Request.Transaction.Reference4 = "";
            _Request.Transaction.Reference5 = "";

            _Request.Address = new LocationReference.Address();
            _Request.Address.City = txtCity.Text.Trim();
            _Request.Address.Line1 = txtLine1.Text.Trim();
            _Request.Address.Line2 = txtLine2.Text.Trim();
            _Request.Address.Line3 = txtLine3.Text.Trim();
            _Request.Address.PostCode = txtPostCode.Text.Trim();
            _Request.Address.StateOrProvinceCode = txtState.Text.Trim();
            _Request.Address.CountryCode = txtCountry.Text.Trim();

            try
            {
                LocationReference.Service_1_0Client _Client = new LocationReference.Service_1_0Client("BasicHttpBinding_Service_1_0");
                var _Response = _Client.ValidateAddress(_Request);

                dgvErrors.DataSource = _Response.Notifications;
                dgvSuggestedAddresses.DataSource = _Response.SuggestedAddresses;

            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message, "Error");
            }
        }

        private void btnCancel_Click(object sender, EventArgs e)
        {
            this.DialogResult = DialogResult.Cancel;
        }
    }
}
