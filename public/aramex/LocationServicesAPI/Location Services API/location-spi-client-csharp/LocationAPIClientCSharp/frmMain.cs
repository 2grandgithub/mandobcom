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
    public partial class frmMain : Form
    {
        public frmMain()
        {
            InitializeComponent();
        }

        private void btnValidateAddress_Click(object sender, EventArgs e)
        {
            using (frmValidateAddress _frmValidateAddress = new frmValidateAddress())
            {
                _frmValidateAddress.ShowDialog(this);
            }
        }

        private void btnFetchCountries_Click(object sender, EventArgs e)
        {
            using (frmFetchCountries _frmFetchCountries = new frmFetchCountries())
            {
                _frmFetchCountries.ShowDialog(this);
            }
        }

        private void btnFetchCountry_Click(object sender, EventArgs e)
        {
            using (frmFetchCountry _frmFetchCountry = new frmFetchCountry())
            {
                _frmFetchCountry.ShowDialog(this);
            }
        }

        private void btnFetchCities_Click(object sender, EventArgs e)
        {
            using (frmFetchCities _frmFetchCities = new frmFetchCities())
            {
                _frmFetchCities.ShowDialog(this);
            }
        }

        private void btnFetchOffices_Click(object sender, EventArgs e)
        {
            using (frmFetchOffices _frmFetchOffices = new frmFetchOffices())
            {
                _frmFetchOffices.ShowDialog(this);
            }
        }

        private void btnExit_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
