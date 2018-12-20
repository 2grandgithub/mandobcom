<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class frmMain
    Inherits System.Windows.Forms.Form

    'Form overrides dispose to clean up the component list.
    <System.Diagnostics.DebuggerNonUserCode()> _
    Protected Overrides Sub Dispose(ByVal disposing As Boolean)
        Try
            If disposing AndAlso components IsNot Nothing Then
                components.Dispose()
            End If
        Finally
            MyBase.Dispose(disposing)
        End Try
    End Sub

    'Required by the Windows Form Designer
    Private components As System.ComponentModel.IContainer

    'NOTE: The following procedure is required by the Windows Form Designer
    'It can be modified using the Windows Form Designer.  
    'Do not modify it using the code editor.
    <System.Diagnostics.DebuggerStepThrough()> _
    Private Sub InitializeComponent()
        Me.tlpOptions = New System.Windows.Forms.TableLayoutPanel()
        Me.lblExit = New System.Windows.Forms.Label()
        Me.lblValidateAddress = New System.Windows.Forms.Label()
        Me.lblFetchCountries = New System.Windows.Forms.Label()
        Me.lblFetchCountry = New System.Windows.Forms.Label()
        Me.lblFetchCities = New System.Windows.Forms.Label()
        Me.lblFetchOffices = New System.Windows.Forms.Label()
        Me.btnExit = New System.Windows.Forms.Button()
        Me.btnFetchOffices = New System.Windows.Forms.Button()
        Me.btnFetchCities = New System.Windows.Forms.Button()
        Me.btnFetchCountry = New System.Windows.Forms.Button()
        Me.btnFetchCountries = New System.Windows.Forms.Button()
        Me.btnValidateAddress = New System.Windows.Forms.Button()
        Me.tlpOptions.SuspendLayout()
        Me.SuspendLayout()
        '
        'tlpOptions
        '
        Me.tlpOptions.ColumnCount = 2
        Me.tlpOptions.ColumnStyles.Add(New System.Windows.Forms.ColumnStyle(System.Windows.Forms.SizeType.Percent, 21.6152!))
        Me.tlpOptions.ColumnStyles.Add(New System.Windows.Forms.ColumnStyle(System.Windows.Forms.SizeType.Percent, 78.3848!))
        Me.tlpOptions.Controls.Add(Me.btnFetchOffices, 0, 4)
        Me.tlpOptions.Controls.Add(Me.btnFetchCities, 0, 3)
        Me.tlpOptions.Controls.Add(Me.btnFetchCountry, 0, 2)
        Me.tlpOptions.Controls.Add(Me.btnFetchCountries, 0, 1)
        Me.tlpOptions.Controls.Add(Me.btnValidateAddress, 0, 0)
        Me.tlpOptions.Controls.Add(Me.lblFetchOffices, 1, 4)
        Me.tlpOptions.Controls.Add(Me.lblFetchCities, 1, 3)
        Me.tlpOptions.Controls.Add(Me.lblFetchCountry, 1, 2)
        Me.tlpOptions.Controls.Add(Me.lblFetchCountries, 1, 1)
        Me.tlpOptions.Controls.Add(Me.lblValidateAddress, 1, 0)
        Me.tlpOptions.Controls.Add(Me.btnExit, 0, 5)
        Me.tlpOptions.Controls.Add(Me.lblExit, 1, 5)
        Me.tlpOptions.Dock = System.Windows.Forms.DockStyle.Fill
        Me.tlpOptions.Location = New System.Drawing.Point(0, 0)
        Me.tlpOptions.Name = "tlpOptions"
        Me.tlpOptions.RowCount = 6
        Me.tlpOptions.RowStyles.Add(New System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667!))
        Me.tlpOptions.RowStyles.Add(New System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667!))
        Me.tlpOptions.RowStyles.Add(New System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667!))
        Me.tlpOptions.RowStyles.Add(New System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667!))
        Me.tlpOptions.RowStyles.Add(New System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667!))
        Me.tlpOptions.RowStyles.Add(New System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667!))
        Me.tlpOptions.Size = New System.Drawing.Size(421, 352)
        Me.tlpOptions.TabIndex = 0
        '
        'lblExit
        '
        Me.lblExit.AutoSize = True
        Me.lblExit.Dock = System.Windows.Forms.DockStyle.Fill
        Me.lblExit.Font = New System.Drawing.Font("Tahoma", 15.0!)
        Me.lblExit.Location = New System.Drawing.Point(94, 290)
        Me.lblExit.Name = "lblExit"
        Me.lblExit.Size = New System.Drawing.Size(324, 62)
        Me.lblExit.TabIndex = 11
        Me.lblExit.Text = "Exit"
        Me.lblExit.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'lblValidateAddress
        '
        Me.lblValidateAddress.AutoSize = True
        Me.lblValidateAddress.Dock = System.Windows.Forms.DockStyle.Fill
        Me.lblValidateAddress.Font = New System.Drawing.Font("Tahoma", 15.0!)
        Me.lblValidateAddress.Location = New System.Drawing.Point(94, 0)
        Me.lblValidateAddress.Name = "lblValidateAddress"
        Me.lblValidateAddress.Size = New System.Drawing.Size(324, 58)
        Me.lblValidateAddress.TabIndex = 1
        Me.lblValidateAddress.Text = "Validate Address"
        Me.lblValidateAddress.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'lblFetchCountries
        '
        Me.lblFetchCountries.AutoSize = True
        Me.lblFetchCountries.Dock = System.Windows.Forms.DockStyle.Fill
        Me.lblFetchCountries.Font = New System.Drawing.Font("Tahoma", 15.0!)
        Me.lblFetchCountries.Location = New System.Drawing.Point(94, 58)
        Me.lblFetchCountries.Name = "lblFetchCountries"
        Me.lblFetchCountries.Size = New System.Drawing.Size(324, 58)
        Me.lblFetchCountries.TabIndex = 3
        Me.lblFetchCountries.Text = "Fetch Countries"
        Me.lblFetchCountries.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'lblFetchCountry
        '
        Me.lblFetchCountry.AutoSize = True
        Me.lblFetchCountry.Dock = System.Windows.Forms.DockStyle.Fill
        Me.lblFetchCountry.Font = New System.Drawing.Font("Tahoma", 15.0!)
        Me.lblFetchCountry.Location = New System.Drawing.Point(94, 116)
        Me.lblFetchCountry.Name = "lblFetchCountry"
        Me.lblFetchCountry.Size = New System.Drawing.Size(324, 58)
        Me.lblFetchCountry.TabIndex = 5
        Me.lblFetchCountry.Text = "Fetch Country"
        Me.lblFetchCountry.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'lblFetchCities
        '
        Me.lblFetchCities.AutoSize = True
        Me.lblFetchCities.Dock = System.Windows.Forms.DockStyle.Fill
        Me.lblFetchCities.Font = New System.Drawing.Font("Tahoma", 15.0!)
        Me.lblFetchCities.Location = New System.Drawing.Point(94, 174)
        Me.lblFetchCities.Name = "lblFetchCities"
        Me.lblFetchCities.Size = New System.Drawing.Size(324, 58)
        Me.lblFetchCities.TabIndex = 7
        Me.lblFetchCities.Text = "Fetch Cities"
        Me.lblFetchCities.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'lblFetchOffices
        '
        Me.lblFetchOffices.AutoSize = True
        Me.lblFetchOffices.Dock = System.Windows.Forms.DockStyle.Fill
        Me.lblFetchOffices.Font = New System.Drawing.Font("Tahoma", 15.0!)
        Me.lblFetchOffices.Location = New System.Drawing.Point(94, 232)
        Me.lblFetchOffices.Name = "lblFetchOffices"
        Me.lblFetchOffices.Size = New System.Drawing.Size(324, 58)
        Me.lblFetchOffices.TabIndex = 9
        Me.lblFetchOffices.Text = "Fetch Offices"
        Me.lblFetchOffices.TextAlign = System.Drawing.ContentAlignment.MiddleLeft
        '
        'btnExit
        '
        Me.btnExit.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.btnExit.Dock = System.Windows.Forms.DockStyle.Fill
        Me.btnExit.Image = Global.LocationAPIClient_Test.My.Resources.Resources._1392243510_exit
        Me.btnExit.Location = New System.Drawing.Point(3, 293)
        Me.btnExit.Name = "btnExit"
        Me.btnExit.Size = New System.Drawing.Size(85, 56)
        Me.btnExit.TabIndex = 10
        Me.btnExit.UseVisualStyleBackColor = True
        '
        'btnFetchOffices
        '
        Me.btnFetchOffices.Dock = System.Windows.Forms.DockStyle.Fill
        Me.btnFetchOffices.Image = Global.LocationAPIClient_Test.My.Resources.Resources._1392243247_companies
        Me.btnFetchOffices.Location = New System.Drawing.Point(3, 235)
        Me.btnFetchOffices.Name = "btnFetchOffices"
        Me.btnFetchOffices.Size = New System.Drawing.Size(85, 52)
        Me.btnFetchOffices.TabIndex = 8
        Me.btnFetchOffices.UseVisualStyleBackColor = True
        '
        'btnFetchCities
        '
        Me.btnFetchCities.Dock = System.Windows.Forms.DockStyle.Fill
        Me.btnFetchCities.Image = Global.LocationAPIClient_Test.My.Resources.Resources._1392243185_Home
        Me.btnFetchCities.Location = New System.Drawing.Point(3, 177)
        Me.btnFetchCities.Name = "btnFetchCities"
        Me.btnFetchCities.Size = New System.Drawing.Size(85, 52)
        Me.btnFetchCities.TabIndex = 6
        Me.btnFetchCities.UseVisualStyleBackColor = True
        '
        'btnFetchCountry
        '
        Me.btnFetchCountry.Dock = System.Windows.Forms.DockStyle.Fill
        Me.btnFetchCountry.Image = Global.LocationAPIClient_Test.My.Resources.Resources._1392243212_companies
        Me.btnFetchCountry.Location = New System.Drawing.Point(3, 119)
        Me.btnFetchCountry.Name = "btnFetchCountry"
        Me.btnFetchCountry.Size = New System.Drawing.Size(85, 52)
        Me.btnFetchCountry.TabIndex = 4
        Me.btnFetchCountry.UseVisualStyleBackColor = True
        '
        'btnFetchCountries
        '
        Me.btnFetchCountries.Dock = System.Windows.Forms.DockStyle.Fill
        Me.btnFetchCountries.Image = Global.LocationAPIClient_Test.My.Resources.Resources._1392243137_buildings
        Me.btnFetchCountries.Location = New System.Drawing.Point(3, 61)
        Me.btnFetchCountries.Name = "btnFetchCountries"
        Me.btnFetchCountries.Size = New System.Drawing.Size(85, 52)
        Me.btnFetchCountries.TabIndex = 2
        Me.btnFetchCountries.UseVisualStyleBackColor = True
        '
        'btnValidateAddress
        '
        Me.btnValidateAddress.Dock = System.Windows.Forms.DockStyle.Fill
        Me.btnValidateAddress.Image = Global.LocationAPIClient_Test.My.Resources.Resources._1392243130_edit_validated
        Me.btnValidateAddress.Location = New System.Drawing.Point(3, 3)
        Me.btnValidateAddress.Name = "btnValidateAddress"
        Me.btnValidateAddress.Size = New System.Drawing.Size(85, 52)
        Me.btnValidateAddress.TabIndex = 0
        Me.btnValidateAddress.UseVisualStyleBackColor = True
        '
        'frmMain
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.CancelButton = Me.btnExit
        Me.ClientSize = New System.Drawing.Size(421, 352)
        Me.Controls.Add(Me.tlpOptions)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.MaximizeBox = False
        Me.Name = "frmMain"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "Location API"
        Me.tlpOptions.ResumeLayout(False)
        Me.tlpOptions.PerformLayout()
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents tlpOptions As System.Windows.Forms.TableLayoutPanel
    Friend WithEvents btnExit As System.Windows.Forms.Button
    Friend WithEvents lblExit As System.Windows.Forms.Label
    Friend WithEvents btnFetchOffices As System.Windows.Forms.Button
    Friend WithEvents btnFetchCities As System.Windows.Forms.Button
    Friend WithEvents btnFetchCountry As System.Windows.Forms.Button
    Friend WithEvents btnFetchCountries As System.Windows.Forms.Button
    Friend WithEvents btnValidateAddress As System.Windows.Forms.Button
    Friend WithEvents lblFetchOffices As System.Windows.Forms.Label
    Friend WithEvents lblFetchCities As System.Windows.Forms.Label
    Friend WithEvents lblFetchCountry As System.Windows.Forms.Label
    Friend WithEvents lblFetchCountries As System.Windows.Forms.Label
    Friend WithEvents lblValidateAddress As System.Windows.Forms.Label
End Class
