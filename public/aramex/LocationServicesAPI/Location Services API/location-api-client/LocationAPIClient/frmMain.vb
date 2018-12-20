Public Class frmMain

#Region "Methods"
    Private Sub btnValidateAddress_Click(sender As Object, e As EventArgs) Handles btnValidateAddress.Click
        Using _frmValidateAddress As New frmValidateAddress
            _frmValidateAddress.ShowDialog(Me)
        End Using
    End Sub

    Private Sub btnFetchCountries_Click(sender As Object, e As EventArgs) Handles btnFetchCountries.Click
        Using _frmFetchCountries As New frmFetchCountries
            _frmFetchCountries.ShowDialog(Me)
        End Using
    End Sub

    Private Sub btnFetchCountry_Click(sender As Object, e As EventArgs) Handles btnFetchCountry.Click
        Using _frmFetchCountry As New frmFetchCountry
            _frmFetchCountry.ShowDialog(Me)
        End Using
    End Sub

    Private Sub btnFetchCities_Click(sender As Object, e As EventArgs) Handles btnFetchCities.Click
        Using _frmFetchCities As New frmFetchCities
            _frmFetchCities.ShowDialog(Me)
        End Using
    End Sub

    Private Sub btnFetchOffices_Click(sender As Object, e As EventArgs) Handles btnFetchOffices.Click
        Using _frmFetchOffices As New frmFetchOffices
            _frmFetchOffices.ShowDialog(Me)
        End Using
    End Sub

    Private Sub btnExit_Click(sender As Object, e As EventArgs) Handles btnExit.Click
        Me.Close()
    End Sub
#End Region
    
End Class