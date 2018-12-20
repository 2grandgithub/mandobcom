Public Class frmValidateAddress

    Private Sub btnCancel_Click(sender As Object, e As EventArgs) Handles btnCancel.Click
        Me.DialogResult = Windows.Forms.DialogResult.Cancel
    End Sub

    Private Sub btnSubmit_Click(sender As Object, e As EventArgs) Handles btnSubmit.Click
        Dim _Request As New LocationReference.AddressValidationRequest()
        _Request.ClientInfo = New LocationReference.ClientInfo()
        _Request.ClientInfo.AccountCountryCode = txtAccountCountryCode.Text.Trim()
        _Request.ClientInfo.AccountEntity = txtAccountEntity.Text.Trim()
        _Request.ClientInfo.AccountNumber = txtAccountNumber.Text.Trim()
        _Request.ClientInfo.AccountPin = txtAccountPin.Text.Trim()
        _Request.ClientInfo.UserName = txtUsername.Text.Trim()
        _Request.ClientInfo.Password = txtPassword.Text.Trim()
        _Request.ClientInfo.Version = txtVersion.Text.Trim()
        _Request.ClientInfo.Source = 24

        _Request.Transaction = New LocationReference.Transaction
        _Request.Transaction.Reference1 = ""
        _Request.Transaction.Reference2 = ""
        _Request.Transaction.Reference3 = ""
        _Request.Transaction.Reference4 = ""
        _Request.Transaction.Reference5 = ""

        _Request.Address = New LocationReference.Address
        _Request.Address.City = txtCity.Text.Trim()
        _Request.Address.Line1 = txtLine1.Text.Trim()
        _Request.Address.Line2 = txtLine2.Text.Trim()
        _Request.Address.Line3 = txtLine3.Text.Trim()
        _Request.Address.PostCode = txtPostCode.Text.Trim()
        _Request.Address.StateOrProvinceCode = txtState.Text.Trim()
        _Request.Address.CountryCode = txtCountry.Text.Trim()

        ''***  OfficesFetchingRequest()

        ''*** test Fetch CountriesFetching
        '_Request.Code = txtCountry.Text.Trim()

        Try
            Dim _Client As New LocationReference.Service_1_0Client("BasicHttpBinding_Service_1_0")
            Dim _Response = _Client.ValidateAddress(_Request)

            dgvErrors.DataSource = _Response.Notifications
            dgvSuggestedAddresses.DataSource = _Response.SuggestedAddresses

        Catch ex As Exception
            MessageBox.Show(ex.Message, "Error")
        End Try
    End Sub
End Class
