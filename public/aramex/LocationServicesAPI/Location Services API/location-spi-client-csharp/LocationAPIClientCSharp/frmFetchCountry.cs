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
    public partial class frmFetchCountry : Form
    {
        public frmFetchCountry()
        {
            InitializeComponent();
        }

        private void btnSubmit_Click(object sender, EventArgs e)
        {
            LocationReference.CountryFetchingRequest _Request = new LocationReference.CountryFetchingRequest();
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

            _Request.Code = txtCountryCode.Text.Trim();

            try
            {
                LocationReference.Service_1_0Client _Client = new LocationReference.Service_1_0Client("BasicHttpBinding_Service_1_0");
                var _Response = _Client.FetchCountry(_Request);

                List<LocationReference.Country> _Countries = new List<LocationReference.Country>();
                _Countries.Add(_Response.Country);
                dgvErrors.DataSource = _Response.Notifications;
                dgvCountries.DataSource = _Countries;

            }
            catch (Exception ex)
            {
                MessageBox.Show(ex.Message, "Error");
            }

        }
    }
}
