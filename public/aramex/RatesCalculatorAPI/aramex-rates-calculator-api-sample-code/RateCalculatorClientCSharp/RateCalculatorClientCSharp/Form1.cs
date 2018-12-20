using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Windows.Forms;
using RateCalculatorClient.RateCalculatorReference;

namespace RateCalculatorClient
{
    public partial class Form1 : Form
    {
        private List<TestCase> _TestCases = null;
        
        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            PrepareTestCases();

            cmbCases.Items.Clear();
            cmbCases.DataSource = _TestCases;
            cmbCases.DisplayMember = "Text";
            cmbCases.ValueMember = "ID";
            cmbCases.Refresh();
        }

        private void PrepareTestCases()
        {
            _TestCases = new List<TestCase>();

            _TestCases.Add(PrepareTestCase1());
            _TestCases.Add(PrepareTestCase2());
        }

        private TestCase PrepareTestCase1()
        {
                RateCalculatorRequest _RateRequest = new RateCalculatorRequest();

                _RateRequest.ClientInfo = new RateCalculatorReference.ClientInfo();
                _RateRequest.ClientInfo.AccountCountryCode = string.Empty;
                _RateRequest.ClientInfo.AccountEntity = string.Empty;
                _RateRequest.ClientInfo.AccountNumber = string.Empty;
                _RateRequest.ClientInfo.AccountPin = string.Empty;
                _RateRequest.ClientInfo.UserName = "reem.sarrif@aramex.com";
                _RateRequest.ClientInfo.Password = "12345678";
                _RateRequest.ClientInfo.Version = "v1.0";

                _RateRequest.Transaction = new RateCalculatorReference.Transaction();
                _RateRequest.Transaction.Reference1 = "001";

                _RateRequest.OriginAddress = new RateCalculatorReference.Address();
                _RateRequest.OriginAddress.City = "Amman";
                _RateRequest.OriginAddress.CountryCode = "JO";

                _RateRequest.DestinationAddress = new RateCalculatorReference.Address();
                _RateRequest.DestinationAddress.City = "Dubai";
                _RateRequest.DestinationAddress.CountryCode = "AE";

                _RateRequest.ShipmentDetails = new RateCalculatorReference.ShipmentDetails();
                _RateRequest.ShipmentDetails.ProductGroup = "EXP";
                _RateRequest.ShipmentDetails.ProductType = "PDX";
                _RateRequest.ShipmentDetails.PaymentType = "P";

                _RateRequest.ShipmentDetails.ActualWeight = new RateCalculatorReference.Weight();
                _RateRequest.ShipmentDetails.ActualWeight.Value = Convert.ToDouble(5);
                _RateRequest.ShipmentDetails.ActualWeight.Unit = "KG";

                _RateRequest.ShipmentDetails.ChargeableWeight = new RateCalculatorReference.Weight();
                _RateRequest.ShipmentDetails.ChargeableWeight.Value = Convert.ToDouble(5);
                _RateRequest.ShipmentDetails.ChargeableWeight.Unit = "LB";

                _RateRequest.ShipmentDetails.NumberOfPieces = 1;

                return new TestCase(1, "Valid Request Without Account Information", "Valid Request Without Account Information", _RateRequest, null);
        }

        private TestCase PrepareTestCase2()
        {
            RateCalculatorRequest _RateRequest = new RateCalculatorRequest();

            _RateRequest.ClientInfo = new RateCalculatorReference.ClientInfo();
            _RateRequest.ClientInfo.AccountCountryCode = "JO";
            _RateRequest.ClientInfo.AccountEntity = "AMM";
            _RateRequest.ClientInfo.AccountNumber = "20016";
            _RateRequest.ClientInfo.AccountPin = "221321";
            _RateRequest.ClientInfo.UserName = "reem.sarrif@aramex.com";
            _RateRequest.ClientInfo.Password = "12345678";
            _RateRequest.ClientInfo.Version = "v1.0";

            _RateRequest.Transaction = new RateCalculatorReference.Transaction();
            _RateRequest.Transaction.Reference1 = "001";

            _RateRequest.OriginAddress = new RateCalculatorReference.Address();
            _RateRequest.OriginAddress.City = "Amman";
            _RateRequest.OriginAddress.CountryCode = "JO";

            _RateRequest.DestinationAddress = new RateCalculatorReference.Address();
            _RateRequest.DestinationAddress.City = "Dubai";
            _RateRequest.DestinationAddress.CountryCode = "AE";

            _RateRequest.ShipmentDetails = new RateCalculatorReference.ShipmentDetails();
            _RateRequest.ShipmentDetails.ProductGroup = "EXP";
            _RateRequest.ShipmentDetails.ProductType = "PDX";
            _RateRequest.ShipmentDetails.PaymentType = "P";

            _RateRequest.ShipmentDetails.ActualWeight = new RateCalculatorReference.Weight();
            _RateRequest.ShipmentDetails.ActualWeight.Value = Convert.ToDouble(5);
            _RateRequest.ShipmentDetails.ActualWeight.Unit = "KG";

            _RateRequest.ShipmentDetails.ChargeableWeight = new RateCalculatorReference.Weight();
            _RateRequest.ShipmentDetails.ChargeableWeight.Value = Convert.ToDouble(5);
            _RateRequest.ShipmentDetails.ChargeableWeight.Unit = "LB";

            _RateRequest.ShipmentDetails.NumberOfPieces = 1;

            return new TestCase(2, "Valid Request With Account Information", "Valid Request With Account Information", _RateRequest, null);
        }

        private void cmbCases_SelectedIndexChanged(object sender, EventArgs e)
        {
            if (cmbCases.SelectedIndex == -1) return;

            Cursor.Current = Cursors.WaitCursor;
            FillTestCase(_TestCases[Convert.ToInt32(cmbCases.SelectedIndex)]);
            Cursor.Current = Cursors.Default;
        }

        private void FillTestCase(TestCase TestCase)
        {
            this.txtDescription.Text = TestCase.Description;

            this.tvOutputRequest.Nodes.Clear();
            tvInputRequest.Nodes.Clear();

            ClientInfo _ClientInfo = TestCase.RateRequest.ClientInfo;
            Transaction _Transaction = TestCase.RateRequest.Transaction;
            Address _OriginAddress = TestCase.RateRequest.OriginAddress;
            Address _DestinationAddress = TestCase.RateRequest.DestinationAddress;
            ShipmentDetails _ShipmentDetails = TestCase.RateRequest.ShipmentDetails;

            TreeNode _ClientInfoNode = new TreeNode("ClientInfo");
            TreeNode _TransactionNode = new TreeNode("Transaction");
            TreeNode _OriginAddressNode = new TreeNode("OriginAddress");
            TreeNode _DestinationAddressNode = new TreeNode("DestinationAddress");
            TreeNode _ShipmentDetailsNode = new TreeNode("ShipmentDetails");

            if (_ClientInfo != null)
            {
                _ClientInfoNode.Nodes.Add("UserName = " + "'" + (string.IsNullOrEmpty(_ClientInfo.UserName) ? string.Empty : _ClientInfo.UserName) + "'");
                _ClientInfoNode.Nodes.Add("Password = " + "'" + (string.IsNullOrEmpty(_ClientInfo.Password) ? string.Empty : _ClientInfo.Password) + "'");
                _ClientInfoNode.Nodes.Add("Version = " + "'" + (string.IsNullOrEmpty(_ClientInfo.Version) ? string.Empty : _ClientInfo.Version) + "'");
                _ClientInfoNode.Nodes.Add("AccountNumber = " + "'" + (string.IsNullOrEmpty(_ClientInfo.AccountNumber) ? string.Empty : _ClientInfo.AccountNumber) + "'");
                _ClientInfoNode.Nodes.Add("AccountPin = " + "'" + (string.IsNullOrEmpty(_ClientInfo.AccountPin) ? string.Empty : _ClientInfo.AccountPin) + "'");
                _ClientInfoNode.Nodes.Add("AccountEntity = " + "'" + (string.IsNullOrEmpty(_ClientInfo.AccountEntity) ? string.Empty : _ClientInfo.AccountEntity) + "'");
                _ClientInfoNode.Nodes.Add("AccountCountryCode = " + "'" + (string.IsNullOrEmpty(_ClientInfo.AccountCountryCode) ? string.Empty : _ClientInfo.AccountCountryCode) + "'");
            }

            if (_Transaction != null)
            {
                _TransactionNode.Nodes.Add("Reference1 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference1) ? string.Empty : _Transaction.Reference1) + "'");
                _TransactionNode.Nodes.Add("Reference2 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference2) ? string.Empty : _Transaction.Reference2) + "'");
                _TransactionNode.Nodes.Add("Reference3 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference3) ? string.Empty : _Transaction.Reference3) + "'");
                _TransactionNode.Nodes.Add("Reference4 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference4) ? string.Empty : _Transaction.Reference4) + "'");
                _TransactionNode.Nodes.Add("Reference5 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference5) ? string.Empty : _Transaction.Reference5) + "'");
            }

            if (_OriginAddress != null)
            {
                _OriginAddressNode.Nodes.Add("Line1 = " + "'" + (string.IsNullOrEmpty(_OriginAddress.Line1) ? string.Empty : _OriginAddress.Line1) + "'");
                _OriginAddressNode.Nodes.Add("Line2 = " + "'" + (string.IsNullOrEmpty(_OriginAddress.Line2) ? string.Empty : _OriginAddress.Line2) + "'");
                _OriginAddressNode.Nodes.Add("Line3 = " + "'" + (string.IsNullOrEmpty(_OriginAddress.Line3) ? string.Empty : _OriginAddress.Line3) + "'");
                _OriginAddressNode.Nodes.Add("City = " + "'" + (string.IsNullOrEmpty(_OriginAddress.City) ? string.Empty : _OriginAddress.City) + "'");
                _OriginAddressNode.Nodes.Add("State = " + "'" + (string.IsNullOrEmpty(_OriginAddress.StateOrProvinceCode) ? string.Empty : _OriginAddress.StateOrProvinceCode) + "'");
                _OriginAddressNode.Nodes.Add("Postcode = " + "'" + (string.IsNullOrEmpty(_OriginAddress.PostCode) ? string.Empty : _OriginAddress.PostCode) + "'");
                _OriginAddressNode.Nodes.Add("Country = " + "'" + (string.IsNullOrEmpty(_OriginAddress.CountryCode) ? string.Empty : _OriginAddress.CountryCode) + "'");
            }

            if (_DestinationAddress != null)
            {
                _DestinationAddressNode.Nodes.Add("Line1 = " + "'" + (string.IsNullOrEmpty(_DestinationAddress.Line1) ? string.Empty : _DestinationAddress.Line1) + "'");
                _DestinationAddressNode.Nodes.Add("Line2 = " + "'" + (string.IsNullOrEmpty(_DestinationAddress.Line2) ? string.Empty : _DestinationAddress.Line2) + "'");
                _DestinationAddressNode.Nodes.Add("Line3 = " + "'" + (string.IsNullOrEmpty(_DestinationAddress.Line3) ? string.Empty : _DestinationAddress.Line3) + "'");
                _DestinationAddressNode.Nodes.Add("City = " + "'" + (string.IsNullOrEmpty(_DestinationAddress.City) ? string.Empty : _DestinationAddress.City) + "'");
                _DestinationAddressNode.Nodes.Add("State = " + "'" + (string.IsNullOrEmpty(_DestinationAddress.StateOrProvinceCode) ? string.Empty : _DestinationAddress.StateOrProvinceCode) + "'");
                _DestinationAddressNode.Nodes.Add("Postcode = " + "'" + (string.IsNullOrEmpty(_DestinationAddress.PostCode) ? string.Empty : _DestinationAddress.PostCode) + "'");
                _DestinationAddressNode.Nodes.Add("Country = " + "'" + (string.IsNullOrEmpty(_DestinationAddress.CountryCode) ? string.Empty : _DestinationAddress.CountryCode) + "'");
            }

            if (_ShipmentDetails != null)
            {
                TreeNode _DimensionsNode = new TreeNode("Dimensions");
                if (_ShipmentDetails.Dimensions != null)
                {
                    _DimensionsNode.Nodes.Add("Length = " + "'" + _ShipmentDetails.Dimensions.Length.ToString() + "'");
                    _DimensionsNode.Nodes.Add("Width = " + "'" + _ShipmentDetails.Dimensions.Width.ToString() + "'");
                    _DimensionsNode.Nodes.Add("Height = " + "'" + _ShipmentDetails.Dimensions.Height.ToString() + "'");
                    _DimensionsNode.Nodes.Add("Unit = " + "'" + _ShipmentDetails.Dimensions.Unit + "'");
                }

                TreeNode _ActualWeightNode = new TreeNode("ActualWeight");
                if (_ShipmentDetails.ActualWeight != null)
                {
                    _ActualWeightNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.ActualWeight.Value.ToString() + "'");
                    _ActualWeightNode.Nodes.Add("Unit = " + "'" + _ShipmentDetails.ActualWeight.Unit + "'");
                }

                TreeNode _ChargeableWeightNode = new TreeNode("ChargeableWeight");
                if (_ShipmentDetails.ChargeableWeight != null)
                {
                    _ChargeableWeightNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.ChargeableWeight.Value.ToString() + "'");
                    _ChargeableWeightNode.Nodes.Add("Unit = " + "'" + _ShipmentDetails.ChargeableWeight.Unit + "'");
                }

                TreeNode _CustomsValueAmountNode = new TreeNode("CustomsValueAmount");
                if (_ShipmentDetails.CustomsValueAmount != null)
                {
                    _CustomsValueAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CustomsValueAmount.Value.ToString() + "'");
                    _CustomsValueAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CustomsValueAmount.CurrencyCode + "'");
                }

                TreeNode _CashOnDeliveryAmountNode = new TreeNode("CashOnDeliveryAmount");
                if (_ShipmentDetails.CashOnDeliveryAmount != null)
                {
                    _CashOnDeliveryAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CashOnDeliveryAmount.Value.ToString() + "'");
                    _CashOnDeliveryAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CashOnDeliveryAmount.CurrencyCode + "'");
                }

                TreeNode _InsuranceAmountNode = new TreeNode("InsuranceAmount");
                if (_ShipmentDetails.InsuranceAmount != null)
                {
                    _InsuranceAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.InsuranceAmount.Value.ToString() + "'");
                    _InsuranceAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.InsuranceAmount.CurrencyCode + "'");
                }

                TreeNode _CashAdditionalAmountNode = new TreeNode("CashAdditionalAmount");
                if (_ShipmentDetails.CashAdditionalAmount != null)
                {
                    _CashAdditionalAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CashAdditionalAmount.Value.ToString() + "'");
                    _CashAdditionalAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CashAdditionalAmount.CurrencyCode + "'");
                }

                TreeNode _CollectAmountNode = new TreeNode("CollectAmount");
                if (_ShipmentDetails.CollectAmount != null)
                {
                    _CollectAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CollectAmount.Value.ToString() + "'");
                    _CollectAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CollectAmount.CurrencyCode + "'");
                }

                _ShipmentDetailsNode.Nodes.Add(_DimensionsNode);
                _ShipmentDetailsNode.Nodes.Add(_ActualWeightNode);
                _ShipmentDetailsNode.Nodes.Add(_ChargeableWeightNode);
                _ShipmentDetailsNode.Nodes.Add("DescriptionOfGoods = " + "'" + (string.IsNullOrEmpty(_ShipmentDetails.DescriptionOfGoods) ? string.Empty : _ShipmentDetails.DescriptionOfGoods) + "'");
                _ShipmentDetailsNode.Nodes.Add("GoodsOriginCountry = " + "'" + (string.IsNullOrEmpty(_ShipmentDetails.GoodsOriginCountry) ? string.Empty : _ShipmentDetails.GoodsOriginCountry) + "'");
                _ShipmentDetailsNode.Nodes.Add("NumberOfPieces = " + "'" + _ShipmentDetails.NumberOfPieces.ToString() + "'");
                _ShipmentDetailsNode.Nodes.Add("ProductGroup = " + "'" + (string.IsNullOrEmpty(_ShipmentDetails.ProductGroup) ? string.Empty : _ShipmentDetails.ProductGroup) + "'");
                _ShipmentDetailsNode.Nodes.Add("ProductType = " + "'" + (string.IsNullOrEmpty(_ShipmentDetails.ProductType) ? string.Empty : _ShipmentDetails.ProductType) + "'");
                _ShipmentDetailsNode.Nodes.Add("PaymentType = " + "'" + (string.IsNullOrEmpty(_ShipmentDetails.PaymentType) ? string.Empty : _ShipmentDetails.PaymentType) + "'");
                _ShipmentDetailsNode.Nodes.Add(_CustomsValueAmountNode);
                _ShipmentDetailsNode.Nodes.Add(_CashOnDeliveryAmountNode);
                _ShipmentDetailsNode.Nodes.Add(_InsuranceAmountNode);
                _ShipmentDetailsNode.Nodes.Add(_CashAdditionalAmountNode);
                _ShipmentDetailsNode.Nodes.Add(_CollectAmountNode);
                _ShipmentDetailsNode.Nodes.Add("Items");
            }

            TreeNode _RequestNode = new TreeNode("Request");
            _RequestNode.Nodes.Add(_ClientInfoNode);
            _RequestNode.Nodes.Add(_TransactionNode);
            _RequestNode.Nodes.Add(_OriginAddressNode);
            _RequestNode.Nodes.Add(_DestinationAddressNode);
            _RequestNode.Nodes.Add(_ShipmentDetailsNode);
                
            this.tvInputRequest.Nodes.Add(_RequestNode);
            this.tvInputRequest.ExpandAll();
        }

        private void btnExit_Click(object sender, EventArgs e)
        {
            this.Close();
        }

        private void btnInvoke_Click(object sender, EventArgs e)
        {
            Cursor.Current = Cursors.WaitCursor;
            TestCase _TestCase = _TestCases[cmbCases.SelectedIndex];
            RateCalculatorReference.Service_1_0Client _Client = new RateCalculatorReference.Service_1_0Client();

            try
            {
                _TestCase.RateResponse = _Client.CalculateRate(_TestCase.RateRequest);
                tvOutputRequest.Nodes.Clear();

                Transaction _Transaction = _TestCase.RateResponse.Transaction;
                Notification[] _Notifications = _TestCase.RateResponse.Notifications;
                bool _HasErrors = _TestCase.RateResponse.HasErrors;
                Money _TotalAmount = _TestCase.RateResponse.TotalAmount;

                TreeNode _TransactionNode = new TreeNode("Transaction");
                TreeNode _NotificationsNode = new TreeNode("Notifications");
                TreeNode _HasErrorsNode = new TreeNode("HasErrors = " + "'" + _HasErrors.ToString() + "'");
                TreeNode _TotalAmountNode = new TreeNode("TotalAmount");
            
                if (_Transaction != null)
                {
                    _TransactionNode.Nodes.Add("Reference1 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference1) ? string.Empty : _Transaction.Reference1) + "'");
                    _TransactionNode.Nodes.Add("Reference2 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference2) ? string.Empty : _Transaction.Reference2) + "'");
                    _TransactionNode.Nodes.Add("Reference3 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference3) ? string.Empty : _Transaction.Reference3) + "'");
                    _TransactionNode.Nodes.Add("Reference4 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference4) ? string.Empty : _Transaction.Reference4) + "'");
                    _TransactionNode.Nodes.Add("Reference5 = " + "'" + (string.IsNullOrEmpty(_Transaction.Reference5) ? string.Empty : _Transaction.Reference5) + "'");
                }

                if (_Notifications != null && _Notifications.Length > 0)
                {
                    for (int _Index = 0; _Index <= _Notifications.Length - 1; _Index++)
                    {
                        TreeNode _NotificationNode = new TreeNode("Notification " + (_Index + 1).ToString());
                        _NotificationNode.Nodes.Add("Code = " + "'" + _Notifications[_Index].Code + "'");
                        _NotificationNode.Nodes.Add("Message = " + "'" + _Notifications[_Index].Message + "'");

                        _NotificationsNode.Nodes.Add(_NotificationNode);
                    }
                }

                if (_TotalAmount != null )
                {
                    _TotalAmountNode.Nodes.Add("Value = " + "'" + _TotalAmount.Value.ToString() + "'");
                    _TotalAmountNode.Nodes.Add("Currency = " + "'" + _TotalAmount.CurrencyCode + "'");
                }

                TreeNode _ResponseNode = new TreeNode("Response");
                _ResponseNode.Nodes.Add(_TransactionNode);
                _ResponseNode.Nodes.Add(_NotificationsNode);
                _ResponseNode.Nodes.Add(_HasErrorsNode);
                _ResponseNode.Nodes.Add(_TotalAmountNode);

                this.tvOutputRequest.Nodes.Add(_ResponseNode);
                this.tvOutputRequest.ExpandAll();
            }
            catch(Exception ex)
            {
                MessageBox.Show(this, ex.Message, "Unhandled Exception", MessageBoxButtons.OK, MessageBoxIcon.Error);
            }
            finally
            {
                _Client.Close();
                _Client = null;
            }
      
            Cursor.Current = Cursors.Default;
        }
    }
}
