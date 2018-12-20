Public Class frmFetchCountries
    Private Sub btnCancel_Click(sender As Object, e As EventArgs) Handles btnCancel.Click
        Me.DialogResult = Windows.Forms.DialogResult.Cancel
    End Sub

    Private Sub btnSubmit_Click(sender As Object, e As EventArgs) Handles btnSubmit.Click
        Dim _Request As New LocationReference.CountriesFetchingRequest()
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

        Try
            Dim _Client As New LocationReference.Service_1_0Client("BasicHttpBinding_Service_1_0")
            Dim _Response = _Client.FetchCountries(_Request)

            dgvErrors.DataSource = _Response.Notifications
            gdvCountries.DataSource = _Response.Countries

        Catch ex As Exception
            MessageBox.Show(ex.Message, "Error")
        End Try
    End Sub
End Class