Imports RateCalculatorClient.RateCalcService

Public Class Form1

    Private _TestCases As List(Of TestCase) = Nothing

    Private Sub Form1_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        PrepareTestCases()

        cmbCases.Items.Clear()
        cmbCases.DataSource = _TestCases
        cmbCases.DisplayMember = "Text"
        cmbCases.ValueMember = "ID"
        cmbCases.Refresh()
    End Sub

    Private Sub PrepareTestCases()
        _TestCases = New List(Of TestCase)

        _TestCases.Add(PrepareTestCase1)
        _TestCases.Add(PrepareTestCase2)
    End Sub

    Private Function PrepareTestCase1() As TestCase
        Dim _RateRequest As New RateCalculatorRequest

        _RateRequest.ClientInfo = New RateCalcService.ClientInfo()
        _RateRequest.ClientInfo.AccountCountryCode = String.Empty
        _RateRequest.ClientInfo.AccountEntity = String.Empty
        _RateRequest.ClientInfo.AccountNumber = String.Empty
        _RateRequest.ClientInfo.AccountPin = String.Empty
        _RateRequest.ClientInfo.UserName = "reem@reem.com"
        _RateRequest.ClientInfo.Password = "123456789"
        _RateRequest.ClientInfo.Version = "v1.0"

        _RateRequest.Transaction = New RateCalcService.Transaction()
        _RateRequest.Transaction.Reference1 = "001"

        _RateRequest.OriginAddress = New RateCalcService.Address()
        _RateRequest.OriginAddress.City = "Dubai"
        _RateRequest.OriginAddress.CountryCode = "AE"

        _RateRequest.DestinationAddress = New RateCalcService.Address()
        _RateRequest.DestinationAddress.PostCode = "SL1 0NS"
        _RateRequest.DestinationAddress.CountryCode = "GB"

        _RateRequest.ShipmentDetails = New RateCalcService.ShipmentDetails()
        _RateRequest.ShipmentDetails.ProductGroup = "EXP"
        _RateRequest.ShipmentDetails.ProductType = "PDX"
        _RateRequest.ShipmentDetails.PaymentType = "P"

        _RateRequest.ShipmentDetails.ActualWeight = New RateCalcService.Weight()
        _RateRequest.ShipmentDetails.ActualWeight.Value = Convert.ToDouble(5)
        _RateRequest.ShipmentDetails.ActualWeight.Unit = "KG"

        _RateRequest.ShipmentDetails.ChargeableWeight = New RateCalcService.Weight()
        _RateRequest.ShipmentDetails.ChargeableWeight.Value = Convert.ToDouble(5)
        _RateRequest.ShipmentDetails.ChargeableWeight.Unit = "LB"

        _RateRequest.ShipmentDetails.NumberOfPieces = 1

        Return New TestCase(1, "Valid Request Without Account Information", "Valid Request Without Account Information", _RateRequest, Nothing)
    End Function

    Private Function PrepareTestCase2() As TestCase
        Dim _RateRequest As New RateCalculatorRequest

        _RateRequest.ClientInfo = New RateCalcService.ClientInfo()
        _RateRequest.ClientInfo.AccountCountryCode = "JO"
        _RateRequest.ClientInfo.AccountEntity = "AMM"
        _RateRequest.ClientInfo.AccountNumber = "001"
        _RateRequest.ClientInfo.AccountPin = "543543"
        _RateRequest.ClientInfo.UserName = "reem@reem.com"
        _RateRequest.ClientInfo.Password = "123456789"
        _RateRequest.ClientInfo.Version = "v1.0"

        _RateRequest.Transaction = New RateCalcService.Transaction()
        _RateRequest.Transaction.Reference1 = "001"

        _RateRequest.OriginAddress = New RateCalcService.Address()
        _RateRequest.OriginAddress.City = "Amman"
        _RateRequest.OriginAddress.CountryCode = "JO"

        _RateRequest.DestinationAddress = New RateCalcService.Address()
        _RateRequest.DestinationAddress.City = "Boston"
        _RateRequest.DestinationAddress.StateOrProvinceCode = "IN"
        _RateRequest.DestinationAddress.PostCode = "47324"
        _RateRequest.DestinationAddress.CountryCode = "US"

        '_RateRequest.DestinationAddress.City = "Slough"
        ''_RateRequest.DestinationAddress.StateOrProvinceCode = "IN"
        '_RateRequest.DestinationAddress.PostCode = "SL1 0NS"
        '_RateRequest.DestinationAddress.CountryCode = "GB"

        _RateRequest.ShipmentDetails = New RateCalcService.ShipmentDetails()
        _RateRequest.ShipmentDetails.ProductGroup = "EXP"
        _RateRequest.ShipmentDetails.ProductType = "PDX"
        _RateRequest.ShipmentDetails.PaymentType = "P"

        _RateRequest.ShipmentDetails.ActualWeight = New RateCalcService.Weight()
        _RateRequest.ShipmentDetails.ActualWeight.Value = Convert.ToDouble(1)
        _RateRequest.ShipmentDetails.ActualWeight.Unit = "KG"

        _RateRequest.ShipmentDetails.ChargeableWeight = New RateCalcService.Weight()
        _RateRequest.ShipmentDetails.ChargeableWeight.Value = Convert.ToDouble(1)
        _RateRequest.ShipmentDetails.ChargeableWeight.Unit = "KG"

        _RateRequest.ShipmentDetails.NumberOfPieces = 1

        Return New TestCase(2, "Valid Request With Account Information", "Valid Request With Account Information", _RateRequest, Nothing)
    End Function

    Private Sub cmbCases_SelectedIndexChanged(ByVal sender As Object, ByVal e As System.EventArgs) Handles cmbCases.SelectedIndexChanged
        If (cmbCases.SelectedIndex = -1) Then Return

        Cursor.Current = Cursors.WaitCursor
        FillTestCase(_TestCases.Item(Convert.ToInt32(cmbCases.SelectedIndex)))
        Cursor.Current = Cursors.Default
    End Sub

    Private Sub FillTestCase(ByVal TestCase As TestCase)
        Me.txtDescription.Text = TestCase.Description

        Me.tvOutputRequest.Nodes.Clear()
        tvInputRequest.Nodes.Clear()

        Dim _ClientInfo As ClientInfo = TestCase.RateRequest.ClientInfo
        Dim _Transaction As Transaction = TestCase.RateRequest.Transaction
        Dim _OriginAddress As Address = TestCase.RateRequest.OriginAddress
        Dim _DestinationAddress As Address = TestCase.RateRequest.DestinationAddress
        Dim _ShipmentDetails As ShipmentDetails = TestCase.RateRequest.ShipmentDetails

        Dim _ClientInfoNode As New TreeNode("ClientInfo")
        Dim _TransactionNode As New TreeNode("Transaction")
        Dim _OriginAddressNode As New TreeNode("OriginAddress")
        Dim _DestinationAddressNode As New TreeNode("DestinationAddress")
        Dim _ShipmentDetailsNode As New TreeNode("ShipmentDetails")

        If (_ClientInfo IsNot Nothing) Then
            _ClientInfoNode.Nodes.Add("UserName = " + "'" + IIf(String.IsNullOrEmpty(_ClientInfo.UserName), String.Empty, _ClientInfo.UserName) + "'")
            _ClientInfoNode.Nodes.Add("Password = " + "'" + IIf(String.IsNullOrEmpty(_ClientInfo.Password), String.Empty, _ClientInfo.Password) + "'")
            _ClientInfoNode.Nodes.Add("Version = " + "'" + IIf(String.IsNullOrEmpty(_ClientInfo.Version), String.Empty, _ClientInfo.Version) + "'")
            _ClientInfoNode.Nodes.Add("AccountNumber = " + "'" + IIf(String.IsNullOrEmpty(_ClientInfo.AccountNumber), String.Empty, _ClientInfo.AccountNumber) + "'")
            _ClientInfoNode.Nodes.Add("AccountPin = " + "'" + IIf(String.IsNullOrEmpty(_ClientInfo.AccountPin), String.Empty, _ClientInfo.AccountPin) + "'")
            _ClientInfoNode.Nodes.Add("AccountEntity = " + "'" + IIf(String.IsNullOrEmpty(_ClientInfo.AccountEntity), String.Empty, _ClientInfo.AccountEntity) + "'")
            _ClientInfoNode.Nodes.Add("AccountCountryCode = " + "'" + IIf(String.IsNullOrEmpty(_ClientInfo.AccountCountryCode), String.Empty, _ClientInfo.AccountCountryCode) + "'")
        End If

        If (_Transaction IsNot Nothing) Then
            _TransactionNode.Nodes.Add("Reference1 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference1), String.Empty, _Transaction.Reference1) + "'")
            _TransactionNode.Nodes.Add("Reference2 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference2), String.Empty, _Transaction.Reference2) + "'")
            _TransactionNode.Nodes.Add("Reference3 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference3), String.Empty, _Transaction.Reference3) + "'")
            _TransactionNode.Nodes.Add("Reference4 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference4), String.Empty, _Transaction.Reference4) + "'")
            _TransactionNode.Nodes.Add("Reference5 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference5), String.Empty, _Transaction.Reference5) + "'")
        End If

        If (_OriginAddress IsNot Nothing) Then
            _OriginAddressNode.Nodes.Add("Line1 = " + "'" + IIf(String.IsNullOrEmpty(_OriginAddress.Line1), String.Empty, _OriginAddress.Line1) + "'")
            _OriginAddressNode.Nodes.Add("Line2 = " + "'" + IIf(String.IsNullOrEmpty(_OriginAddress.Line2), String.Empty, _OriginAddress.Line2) + "'")
            _OriginAddressNode.Nodes.Add("Line3 = " + "'" + IIf(String.IsNullOrEmpty(_OriginAddress.Line3), String.Empty, _OriginAddress.Line3) + "'")
            _OriginAddressNode.Nodes.Add("City = " + "'" + IIf(String.IsNullOrEmpty(_OriginAddress.City), String.Empty, _OriginAddress.City) + "'")
            _OriginAddressNode.Nodes.Add("State = " + "'" + IIf(String.IsNullOrEmpty(_OriginAddress.StateOrProvinceCode), String.Empty, _OriginAddress.StateOrProvinceCode) + "'")
            _OriginAddressNode.Nodes.Add("Postcode = " + "'" + IIf(String.IsNullOrEmpty(_OriginAddress.PostCode), String.Empty, _OriginAddress.PostCode) + "'")
            _OriginAddressNode.Nodes.Add("Country = " + "'" + IIf(String.IsNullOrEmpty(_OriginAddress.CountryCode), String.Empty, _OriginAddress.CountryCode) + "'")
        End If

        If (_DestinationAddress IsNot Nothing) Then
            _DestinationAddressNode.Nodes.Add("Line1 = " + "'" + IIf(String.IsNullOrEmpty(_DestinationAddress.Line1), String.Empty, _DestinationAddress.Line1) + "'")
            _DestinationAddressNode.Nodes.Add("Line2 = " + "'" + IIf(String.IsNullOrEmpty(_DestinationAddress.Line2), String.Empty, _DestinationAddress.Line2) + "'")
            _DestinationAddressNode.Nodes.Add("Line3 = " + "'" + IIf(String.IsNullOrEmpty(_DestinationAddress.Line3), String.Empty, _DestinationAddress.Line3) + "'")
            _DestinationAddressNode.Nodes.Add("City = " + "'" + IIf(String.IsNullOrEmpty(_DestinationAddress.City), String.Empty, _DestinationAddress.City) + "'")
            _DestinationAddressNode.Nodes.Add("State = " + "'" + IIf(String.IsNullOrEmpty(_DestinationAddress.StateOrProvinceCode), String.Empty, _DestinationAddress.StateOrProvinceCode) + "'")
            _DestinationAddressNode.Nodes.Add("Postcode = " + "'" + IIf(String.IsNullOrEmpty(_DestinationAddress.PostCode), String.Empty, _DestinationAddress.PostCode) + "'")
            _DestinationAddressNode.Nodes.Add("Country = " + "'" + IIf(String.IsNullOrEmpty(_DestinationAddress.CountryCode), String.Empty, _DestinationAddress.CountryCode) + "'")
        End If

        If (_ShipmentDetails IsNot Nothing) Then
            Dim _DimensionsNode As New TreeNode("Dimensions")
            If (_ShipmentDetails.Dimensions IsNot Nothing) Then
                _DimensionsNode.Nodes.Add("Length = " + "'" + _ShipmentDetails.Dimensions.Length.ToString() + "'")
                _DimensionsNode.Nodes.Add("Width = " + "'" + _ShipmentDetails.Dimensions.Width.ToString() + "'")
                _DimensionsNode.Nodes.Add("Height = " + "'" + _ShipmentDetails.Dimensions.Height.ToString() + "'")
                _DimensionsNode.Nodes.Add("Unit = " + "'" + _ShipmentDetails.Dimensions.Unit.ToString() + "'")
            End If

            Dim _ActualWeightNode As New TreeNode("ActualWeight")
            If (_ShipmentDetails.ActualWeight IsNot Nothing) Then
                _ActualWeightNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.ActualWeight.Value.ToString() + "'")
                _ActualWeightNode.Nodes.Add("Unit = " + "'" + _ShipmentDetails.ActualWeight.Unit.ToString() + "'")
            End If

            Dim _ChargeableWeightNode As New TreeNode("ChargeableWeight")
            If (_ShipmentDetails.ChargeableWeight IsNot Nothing) Then
                _ChargeableWeightNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.ChargeableWeight.Value.ToString() + "'")
                _ChargeableWeightNode.Nodes.Add("Unit = " + "'" + If(String.IsNullOrEmpty(_ShipmentDetails.ChargeableWeight.Unit), String.Empty, _ShipmentDetails.ChargeableWeight.Unit.ToString()) + "'")
            End If

            Dim _CustomsValueAmountNode As New TreeNode("CustomsValueAmount")
            If (_ShipmentDetails.CustomsValueAmount IsNot Nothing) Then
                _CustomsValueAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CustomsValueAmount.Value.ToString() + "'")
                _CustomsValueAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CustomsValueAmount.CurrencyCode.ToString() + "'")
            End If

            Dim _CashOnDeliveryAmountNode As New TreeNode("CashOnDeliveryAmount")
            If (_ShipmentDetails.CashOnDeliveryAmount IsNot Nothing) Then
                _CashOnDeliveryAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CashOnDeliveryAmount.Value.ToString() + "'")
                _CashOnDeliveryAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CashOnDeliveryAmount.CurrencyCode.ToString() + "'")
            End If

            Dim _InsuranceAmountNode As New TreeNode("InsuranceAmount")
            If (_ShipmentDetails.InsuranceAmount IsNot Nothing) Then
                _InsuranceAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.InsuranceAmount.Value.ToString() + "'")
                _InsuranceAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.InsuranceAmount.CurrencyCode.ToString() + "'")
            End If

            Dim _CashAdditionalAmountNode As New TreeNode("CashAdditionalAmount")
            If (_ShipmentDetails.CashAdditionalAmount IsNot Nothing) Then
                _CashAdditionalAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CashAdditionalAmount.Value.ToString() + "'")
                _CashAdditionalAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CashAdditionalAmount.CurrencyCode.ToString() + "'")
            End If

            Dim _CollectAmountNode As New TreeNode("CollectAmount")
            If (_ShipmentDetails.CollectAmount IsNot Nothing) Then
                _CollectAmountNode.Nodes.Add("Value = " + "'" + _ShipmentDetails.CollectAmount.Value.ToString() + "'")
                _CollectAmountNode.Nodes.Add("Currency = " + "'" + _ShipmentDetails.CollectAmount.CurrencyCode.ToString() + "'")
            End If

            _ShipmentDetailsNode.Nodes.Add(_DimensionsNode)
            _ShipmentDetailsNode.Nodes.Add(_ActualWeightNode)
            _ShipmentDetailsNode.Nodes.Add(_ChargeableWeightNode)
            _ShipmentDetailsNode.Nodes.Add("DescriptionOfGoods = " + "'" + IIf(String.IsNullOrEmpty(_ShipmentDetails.DescriptionOfGoods), String.Empty, _ShipmentDetails.DescriptionOfGoods) + "'")
            _ShipmentDetailsNode.Nodes.Add("GoodsOriginCountry = " + "'" + IIf(String.IsNullOrEmpty(_ShipmentDetails.GoodsOriginCountry), String.Empty, _ShipmentDetails.GoodsOriginCountry) + "'")
            _ShipmentDetailsNode.Nodes.Add("NumberOfPieces = " + "'" + _ShipmentDetails.NumberOfPieces.ToString() + "'")
            _ShipmentDetailsNode.Nodes.Add("ProductGroup = " + "'" + IIf(String.IsNullOrEmpty(_ShipmentDetails.ProductGroup), String.Empty, _ShipmentDetails.ProductGroup) + "'")
            _ShipmentDetailsNode.Nodes.Add("ProductType = " + "'" + IIf(String.IsNullOrEmpty(_ShipmentDetails.ProductType), String.Empty, _ShipmentDetails.ProductType) + "'")
            _ShipmentDetailsNode.Nodes.Add("PaymentType = " + "'" + IIf(String.IsNullOrEmpty(_ShipmentDetails.PaymentType), String.Empty, _ShipmentDetails.PaymentType) + "'")
            _ShipmentDetailsNode.Nodes.Add(_CustomsValueAmountNode)
            _ShipmentDetailsNode.Nodes.Add(_CashOnDeliveryAmountNode)
            _ShipmentDetailsNode.Nodes.Add(_InsuranceAmountNode)
            _ShipmentDetailsNode.Nodes.Add(_CashAdditionalAmountNode)
            _ShipmentDetailsNode.Nodes.Add(_CollectAmountNode)
            _ShipmentDetailsNode.Nodes.Add("Items")
        End If

        Dim _RequestNode As New TreeNode("Request")
        _RequestNode.Nodes.Add(_ClientInfoNode)
        _RequestNode.Nodes.Add(_TransactionNode)
        _RequestNode.Nodes.Add(_OriginAddressNode)
        _RequestNode.Nodes.Add(_DestinationAddressNode)
        _RequestNode.Nodes.Add(_ShipmentDetailsNode)

        Me.tvInputRequest.Nodes.Add(_RequestNode)
        Me.tvInputRequest.ExpandAll()
    End Sub

    Private Sub btnExit_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnExit.Click
        Me.Close()
    End Sub

    Private Sub btnInvoke_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnInvoke.Click
        Cursor.Current = Cursors.WaitCursor
        Dim _TestCase As TestCase = _TestCases.Item(cmbCases.SelectedIndex)

        Dim _Client As New RateCalcService.Service_1_0Client
        Try
            _TestCase.RateResponse = _Client.CalculateRate(_TestCase.RateRequest)
            tvOutputRequest.Nodes.Clear()

            Dim _Transaction As Transaction = _TestCase.RateResponse.Transaction
            Dim _Notifications() As Notification = _TestCase.RateResponse.Notifications
            Dim _HasErrors As Boolean = _TestCase.RateResponse.HasErrors
            Dim _TotalAmount As Money = _TestCase.RateResponse.TotalAmount

            Dim _TransactionNode As New TreeNode("Transaction")
            Dim _NotificationsNode As New TreeNode("Notifications")
            Dim _HasErrorsNode As New TreeNode("HasErrors = " + "'" + _HasErrors.ToString() + "'")
            Dim _TotalAmountNode As New TreeNode("TotalAmount")

            If (_Transaction IsNot Nothing) Then
                _TransactionNode.Nodes.Add("Reference1 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference1), String.Empty, _Transaction.Reference1) + "'")
                _TransactionNode.Nodes.Add("Reference2 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference2), String.Empty, _Transaction.Reference2) + "'")
                _TransactionNode.Nodes.Add("Reference3 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference3), String.Empty, _Transaction.Reference3) + "'")
                _TransactionNode.Nodes.Add("Reference4 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference4), String.Empty, _Transaction.Reference4) + "'")
                _TransactionNode.Nodes.Add("Reference5 = " + "'" + IIf(String.IsNullOrEmpty(_Transaction.Reference5), String.Empty, _Transaction.Reference5) + "'")
            End If

            If (_Notifications IsNot Nothing AndAlso _Notifications.Length > 0) Then
                Dim _Index As Integer = 0
                For _Index = 0 To _Notifications.Length - 1
                    Dim _NotificationNode As New TreeNode("Notification " + (_Index + 1).ToString())
                    _NotificationNode.Nodes.Add("Code = " + "'" + _Notifications(_Index).Code + "'")
                    _NotificationNode.Nodes.Add("Message = " + "'" + _Notifications(_Index).Message + "'")

                    _NotificationsNode.Nodes.Add(_NotificationNode)
                Next
            End If

            If (_TotalAmount IsNot Nothing) Then
                _TotalAmountNode.Nodes.Add("Value = " + "'" + _TotalAmount.Value.ToString() + "'")
                _TotalAmountNode.Nodes.Add("Currency = " + "'" + _TotalAmount.CurrencyCode.ToString() + "'")
            End If

            Dim _ResponseNode As New TreeNode("Response")
            _ResponseNode.Nodes.Add(_TransactionNode)
            _ResponseNode.Nodes.Add(_NotificationsNode)
            _ResponseNode.Nodes.Add(_HasErrorsNode)
            _ResponseNode.Nodes.Add(_TotalAmountNode)

            Me.tvOutputRequest.Nodes.Add(_ResponseNode)
            Me.tvOutputRequest.ExpandAll()
        Catch ex As Exception
            MessageBox.Show(Me, ex.Message, "Unhandled Exception", MessageBoxButtons.OK, MessageBoxIcon.Error)
        Finally
            _Client.Close()
            _Client = Nothing
        End Try

        Cursor.Current = Cursors.Default
    End Sub
End Class
