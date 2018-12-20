<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class frmValidateAddress
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
        Me.btnSubmit = New System.Windows.Forms.Button()
        Me.txtCountry = New System.Windows.Forms.TextBox()
        Me.lblCountry = New System.Windows.Forms.Label()
        Me.txtState = New System.Windows.Forms.TextBox()
        Me.lblState = New System.Windows.Forms.Label()
        Me.txtPostCode = New System.Windows.Forms.TextBox()
        Me.lblPostCode = New System.Windows.Forms.Label()
        Me.txtCity = New System.Windows.Forms.TextBox()
        Me.lblCity = New System.Windows.Forms.Label()
        Me.txtLine3 = New System.Windows.Forms.TextBox()
        Me.lblSuggestedAddresses = New System.Windows.Forms.Label()
        Me.lblErrors = New System.Windows.Forms.Label()
        Me.dgvSuggestedAddresses = New System.Windows.Forms.DataGridView()
        Me.dgvErrors = New System.Windows.Forms.DataGridView()
        Me.lblLine3 = New System.Windows.Forms.Label()
        Me.txtLine2 = New System.Windows.Forms.TextBox()
        Me.lblLine2 = New System.Windows.Forms.Label()
        Me.txtLine1 = New System.Windows.Forms.TextBox()
        Me.btnCancel = New System.Windows.Forms.Button()
        Me.lblLine1 = New System.Windows.Forms.Label()
        Me.gbAddressDetails = New System.Windows.Forms.GroupBox()
        Me.gcClientInfo = New System.Windows.Forms.GroupBox()
        Me.lblVersion = New System.Windows.Forms.Label()
        Me.lblAccountEntity = New System.Windows.Forms.Label()
        Me.lblAccountCountry = New System.Windows.Forms.Label()
        Me.lblAccountPin = New System.Windows.Forms.Label()
        Me.lblAccountNumber = New System.Windows.Forms.Label()
        Me.lblPassword = New System.Windows.Forms.Label()
        Me.lblUsername = New System.Windows.Forms.Label()
        Me.txtVersion = New System.Windows.Forms.TextBox()
        Me.txtAccountEntity = New System.Windows.Forms.TextBox()
        Me.txtAccountCountryCode = New System.Windows.Forms.TextBox()
        Me.txtAccountPin = New System.Windows.Forms.TextBox()
        Me.txtAccountNumber = New System.Windows.Forms.TextBox()
        Me.txtPassword = New System.Windows.Forms.TextBox()
        Me.txtUsername = New System.Windows.Forms.TextBox()
        CType(Me.dgvSuggestedAddresses, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.dgvErrors, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.gbAddressDetails.SuspendLayout()
        Me.gcClientInfo.SuspendLayout()
        Me.SuspendLayout()
        '
        'btnSubmit
        '
        Me.btnSubmit.Location = New System.Drawing.Point(407, 529)
        Me.btnSubmit.Name = "btnSubmit"
        Me.btnSubmit.Size = New System.Drawing.Size(75, 23)
        Me.btnSubmit.TabIndex = 12
        Me.btnSubmit.Text = "Submit"
        Me.btnSubmit.UseVisualStyleBackColor = True
        '
        'txtCountry
        '
        Me.txtCountry.Location = New System.Drawing.Point(75, 170)
        Me.txtCountry.MaxLength = 100
        Me.txtCountry.Name = "txtCountry"
        Me.txtCountry.Size = New System.Drawing.Size(167, 20)
        Me.txtCountry.TabIndex = 13
        '
        'lblCountry
        '
        Me.lblCountry.AutoSize = True
        Me.lblCountry.Location = New System.Drawing.Point(6, 174)
        Me.lblCountry.Name = "lblCountry"
        Me.lblCountry.Size = New System.Drawing.Size(50, 13)
        Me.lblCountry.TabIndex = 12
        Me.lblCountry.Text = "Country:"
        '
        'txtState
        '
        Me.txtState.Location = New System.Drawing.Point(75, 144)
        Me.txtState.MaxLength = 100
        Me.txtState.Name = "txtState"
        Me.txtState.Size = New System.Drawing.Size(167, 20)
        Me.txtState.TabIndex = 11
        '
        'lblState
        '
        Me.lblState.AutoSize = True
        Me.lblState.Location = New System.Drawing.Point(6, 147)
        Me.lblState.Name = "lblState"
        Me.lblState.Size = New System.Drawing.Size(37, 13)
        Me.lblState.TabIndex = 10
        Me.lblState.Text = "State:"
        '
        'txtPostCode
        '
        Me.txtPostCode.Location = New System.Drawing.Point(75, 118)
        Me.txtPostCode.MaxLength = 100
        Me.txtPostCode.Name = "txtPostCode"
        Me.txtPostCode.Size = New System.Drawing.Size(167, 20)
        Me.txtPostCode.TabIndex = 9
        '
        'lblPostCode
        '
        Me.lblPostCode.AutoSize = True
        Me.lblPostCode.Location = New System.Drawing.Point(6, 122)
        Me.lblPostCode.Name = "lblPostCode"
        Me.lblPostCode.Size = New System.Drawing.Size(60, 13)
        Me.lblPostCode.TabIndex = 8
        Me.lblPostCode.Text = "Post Code:"
        '
        'txtCity
        '
        Me.txtCity.Location = New System.Drawing.Point(75, 92)
        Me.txtCity.MaxLength = 100
        Me.txtCity.Name = "txtCity"
        Me.txtCity.Size = New System.Drawing.Size(167, 20)
        Me.txtCity.TabIndex = 7
        '
        'lblCity
        '
        Me.lblCity.AutoSize = True
        Me.lblCity.Location = New System.Drawing.Point(6, 96)
        Me.lblCity.Name = "lblCity"
        Me.lblCity.Size = New System.Drawing.Size(30, 13)
        Me.lblCity.TabIndex = 6
        Me.lblCity.Text = "City:"
        '
        'txtLine3
        '
        Me.txtLine3.Location = New System.Drawing.Point(75, 66)
        Me.txtLine3.MaxLength = 100
        Me.txtLine3.Name = "txtLine3"
        Me.txtLine3.Size = New System.Drawing.Size(167, 20)
        Me.txtLine3.TabIndex = 5
        '
        'lblSuggestedAddresses
        '
        Me.lblSuggestedAddresses.AutoSize = True
        Me.lblSuggestedAddresses.Location = New System.Drawing.Point(14, 380)
        Me.lblSuggestedAddresses.Name = "lblSuggestedAddresses"
        Me.lblSuggestedAddresses.Size = New System.Drawing.Size(149, 13)
        Me.lblSuggestedAddresses.TabIndex = 10
        Me.lblSuggestedAddresses.Text = "Suggested Addresses (if any)"
        '
        'lblErrors
        '
        Me.lblErrors.AutoSize = True
        Me.lblErrors.Location = New System.Drawing.Point(14, 233)
        Me.lblErrors.Name = "lblErrors"
        Me.lblErrors.Size = New System.Drawing.Size(74, 13)
        Me.lblErrors.TabIndex = 8
        Me.lblErrors.Text = "Errors (if any)"
        '
        'dgvSuggestedAddresses
        '
        Me.dgvSuggestedAddresses.AllowUserToAddRows = False
        Me.dgvSuggestedAddresses.AllowUserToDeleteRows = False
        Me.dgvSuggestedAddresses.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize
        Me.dgvSuggestedAddresses.Location = New System.Drawing.Point(11, 396)
        Me.dgvSuggestedAddresses.Name = "dgvSuggestedAddresses"
        Me.dgvSuggestedAddresses.ReadOnly = True
        Me.dgvSuggestedAddresses.Size = New System.Drawing.Size(550, 127)
        Me.dgvSuggestedAddresses.TabIndex = 11
        '
        'dgvErrors
        '
        Me.dgvErrors.AllowUserToAddRows = False
        Me.dgvErrors.AllowUserToDeleteRows = False
        Me.dgvErrors.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize
        Me.dgvErrors.Location = New System.Drawing.Point(12, 251)
        Me.dgvErrors.Name = "dgvErrors"
        Me.dgvErrors.ReadOnly = True
        Me.dgvErrors.Size = New System.Drawing.Size(550, 127)
        Me.dgvErrors.TabIndex = 9
        '
        'lblLine3
        '
        Me.lblLine3.AutoSize = True
        Me.lblLine3.Location = New System.Drawing.Point(6, 70)
        Me.lblLine3.Name = "lblLine3"
        Me.lblLine3.Size = New System.Drawing.Size(39, 13)
        Me.lblLine3.TabIndex = 4
        Me.lblLine3.Text = "Line 3:"
        '
        'txtLine2
        '
        Me.txtLine2.Location = New System.Drawing.Point(75, 40)
        Me.txtLine2.MaxLength = 100
        Me.txtLine2.Name = "txtLine2"
        Me.txtLine2.Size = New System.Drawing.Size(167, 20)
        Me.txtLine2.TabIndex = 3
        '
        'lblLine2
        '
        Me.lblLine2.AutoSize = True
        Me.lblLine2.Location = New System.Drawing.Point(6, 43)
        Me.lblLine2.Name = "lblLine2"
        Me.lblLine2.Size = New System.Drawing.Size(39, 13)
        Me.lblLine2.TabIndex = 2
        Me.lblLine2.Text = "Line 2:"
        '
        'txtLine1
        '
        Me.txtLine1.Location = New System.Drawing.Point(75, 14)
        Me.txtLine1.MaxLength = 100
        Me.txtLine1.Name = "txtLine1"
        Me.txtLine1.Size = New System.Drawing.Size(167, 20)
        Me.txtLine1.TabIndex = 1
        '
        'btnCancel
        '
        Me.btnCancel.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.btnCancel.Location = New System.Drawing.Point(488, 529)
        Me.btnCancel.Name = "btnCancel"
        Me.btnCancel.Size = New System.Drawing.Size(75, 23)
        Me.btnCancel.TabIndex = 13
        Me.btnCancel.Text = "Cancel"
        Me.btnCancel.UseVisualStyleBackColor = True
        '
        'lblLine1
        '
        Me.lblLine1.AutoSize = True
        Me.lblLine1.Location = New System.Drawing.Point(6, 18)
        Me.lblLine1.Name = "lblLine1"
        Me.lblLine1.Size = New System.Drawing.Size(39, 13)
        Me.lblLine1.TabIndex = 0
        Me.lblLine1.Text = "Line 1:"
        '
        'gbAddressDetails
        '
        Me.gbAddressDetails.Controls.Add(Me.txtCountry)
        Me.gbAddressDetails.Controls.Add(Me.lblCountry)
        Me.gbAddressDetails.Controls.Add(Me.txtState)
        Me.gbAddressDetails.Controls.Add(Me.lblState)
        Me.gbAddressDetails.Controls.Add(Me.txtPostCode)
        Me.gbAddressDetails.Controls.Add(Me.lblPostCode)
        Me.gbAddressDetails.Controls.Add(Me.txtCity)
        Me.gbAddressDetails.Controls.Add(Me.lblCity)
        Me.gbAddressDetails.Controls.Add(Me.txtLine3)
        Me.gbAddressDetails.Controls.Add(Me.lblLine3)
        Me.gbAddressDetails.Controls.Add(Me.txtLine2)
        Me.gbAddressDetails.Controls.Add(Me.lblLine2)
        Me.gbAddressDetails.Controls.Add(Me.txtLine1)
        Me.gbAddressDetails.Controls.Add(Me.lblLine1)
        Me.gbAddressDetails.Location = New System.Drawing.Point(297, 21)
        Me.gbAddressDetails.Name = "gbAddressDetails"
        Me.gbAddressDetails.Size = New System.Drawing.Size(265, 198)
        Me.gbAddressDetails.TabIndex = 7
        Me.gbAddressDetails.TabStop = False
        Me.gbAddressDetails.Text = "Address Details"
        '
        'gcClientInfo
        '
        Me.gcClientInfo.Controls.Add(Me.lblVersion)
        Me.gcClientInfo.Controls.Add(Me.lblAccountEntity)
        Me.gcClientInfo.Controls.Add(Me.lblAccountCountry)
        Me.gcClientInfo.Controls.Add(Me.lblAccountPin)
        Me.gcClientInfo.Controls.Add(Me.lblAccountNumber)
        Me.gcClientInfo.Controls.Add(Me.lblPassword)
        Me.gcClientInfo.Controls.Add(Me.lblUsername)
        Me.gcClientInfo.Controls.Add(Me.txtVersion)
        Me.gcClientInfo.Controls.Add(Me.txtAccountEntity)
        Me.gcClientInfo.Controls.Add(Me.txtAccountCountryCode)
        Me.gcClientInfo.Controls.Add(Me.txtAccountPin)
        Me.gcClientInfo.Controls.Add(Me.txtAccountNumber)
        Me.gcClientInfo.Controls.Add(Me.txtPassword)
        Me.gcClientInfo.Controls.Add(Me.txtUsername)
        Me.gcClientInfo.Location = New System.Drawing.Point(11, 21)
        Me.gcClientInfo.Name = "gcClientInfo"
        Me.gcClientInfo.Size = New System.Drawing.Size(278, 198)
        Me.gcClientInfo.TabIndex = 14
        Me.gcClientInfo.TabStop = False
        Me.gcClientInfo.Text = "ClientInfo"
        '
        'lblVersion
        '
        Me.lblVersion.AutoSize = True
        Me.lblVersion.Location = New System.Drawing.Point(6, 174)
        Me.lblVersion.Name = "lblVersion"
        Me.lblVersion.Size = New System.Drawing.Size(46, 13)
        Me.lblVersion.TabIndex = 12
        Me.lblVersion.Text = "Version:"
        '
        'lblAccountEntity
        '
        Me.lblAccountEntity.AutoSize = True
        Me.lblAccountEntity.Location = New System.Drawing.Point(6, 147)
        Me.lblAccountEntity.Name = "lblAccountEntity"
        Me.lblAccountEntity.Size = New System.Drawing.Size(63, 13)
        Me.lblAccountEntity.TabIndex = 10
        Me.lblAccountEntity.Text = "Acc. Entity:"
        '
        'lblAccountCountry
        '
        Me.lblAccountCountry.AutoSize = True
        Me.lblAccountCountry.Location = New System.Drawing.Point(6, 122)
        Me.lblAccountCountry.Name = "lblAccountCountry"
        Me.lblAccountCountry.Size = New System.Drawing.Size(74, 13)
        Me.lblAccountCountry.TabIndex = 8
        Me.lblAccountCountry.Text = "Acc. Country:"
        '
        'lblAccountPin
        '
        Me.lblAccountPin.AutoSize = True
        Me.lblAccountPin.Location = New System.Drawing.Point(6, 96)
        Me.lblAccountPin.Name = "lblAccountPin"
        Me.lblAccountPin.Size = New System.Drawing.Size(49, 13)
        Me.lblAccountPin.TabIndex = 6
        Me.lblAccountPin.Text = "Acc. Pin:"
        '
        'lblAccountNumber
        '
        Me.lblAccountNumber.AutoSize = True
        Me.lblAccountNumber.Location = New System.Drawing.Point(6, 70)
        Me.lblAccountNumber.Name = "lblAccountNumber"
        Me.lblAccountNumber.Size = New System.Drawing.Size(52, 13)
        Me.lblAccountNumber.TabIndex = 4
        Me.lblAccountNumber.Text = "Acc. No.:"
        '
        'lblPassword
        '
        Me.lblPassword.AutoSize = True
        Me.lblPassword.Location = New System.Drawing.Point(6, 43)
        Me.lblPassword.Name = "lblPassword"
        Me.lblPassword.Size = New System.Drawing.Size(57, 13)
        Me.lblPassword.TabIndex = 2
        Me.lblPassword.Text = "Password:"
        '
        'lblUsername
        '
        Me.lblUsername.AutoSize = True
        Me.lblUsername.Location = New System.Drawing.Point(6, 18)
        Me.lblUsername.Name = "lblUsername"
        Me.lblUsername.Size = New System.Drawing.Size(59, 13)
        Me.lblUsername.TabIndex = 0
        Me.lblUsername.Text = "Username:"
        '
        'txtVersion
        '
        Me.txtVersion.Location = New System.Drawing.Point(89, 170)
        Me.txtVersion.Name = "txtVersion"
        Me.txtVersion.Size = New System.Drawing.Size(167, 20)
        Me.txtVersion.TabIndex = 13
        Me.txtVersion.Text = "1.0"
        '
        'txtAccountEntity
        '
        Me.txtAccountEntity.Location = New System.Drawing.Point(89, 144)
        Me.txtAccountEntity.Name = "txtAccountEntity"
        Me.txtAccountEntity.Size = New System.Drawing.Size(167, 20)
        Me.txtAccountEntity.TabIndex = 11
        Me.txtAccountEntity.Text = "AMM"
        '
        'txtAccountCountryCode
        '
        Me.txtAccountCountryCode.Location = New System.Drawing.Point(89, 118)
        Me.txtAccountCountryCode.Name = "txtAccountCountryCode"
        Me.txtAccountCountryCode.Size = New System.Drawing.Size(167, 20)
        Me.txtAccountCountryCode.TabIndex = 9
        Me.txtAccountCountryCode.Text = "JO"
        '
        'txtAccountPin
        '
        Me.txtAccountPin.Location = New System.Drawing.Point(89, 92)
        Me.txtAccountPin.Name = "txtAccountPin"
        Me.txtAccountPin.Size = New System.Drawing.Size(167, 20)
        Me.txtAccountPin.TabIndex = 7
        Me.txtAccountPin.Text = "221321"
        '
        'txtAccountNumber
        '
        Me.txtAccountNumber.Location = New System.Drawing.Point(89, 66)
        Me.txtAccountNumber.Name = "txtAccountNumber"
        Me.txtAccountNumber.Size = New System.Drawing.Size(167, 20)
        Me.txtAccountNumber.TabIndex = 5
        Me.txtAccountNumber.Text = "20016"
        '
        'txtPassword
        '
        Me.txtPassword.Location = New System.Drawing.Point(89, 40)
        Me.txtPassword.Name = "txtPassword"
        Me.txtPassword.Size = New System.Drawing.Size(167, 20)
        Me.txtPassword.TabIndex = 3
        Me.txtPassword.Text = "123456789"
        '
        'txtUsername
        '
        Me.txtUsername.Location = New System.Drawing.Point(89, 14)
        Me.txtUsername.Name = "txtUsername"
        Me.txtUsername.Size = New System.Drawing.Size(167, 20)
        Me.txtUsername.TabIndex = 1
        Me.txtUsername.Text = "reem@reem.com"
        '
        'frmValidateAddress
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(572, 564)
        Me.Controls.Add(Me.gcClientInfo)
        Me.Controls.Add(Me.btnSubmit)
        Me.Controls.Add(Me.lblSuggestedAddresses)
        Me.Controls.Add(Me.lblErrors)
        Me.Controls.Add(Me.dgvSuggestedAddresses)
        Me.Controls.Add(Me.dgvErrors)
        Me.Controls.Add(Me.btnCancel)
        Me.Controls.Add(Me.gbAddressDetails)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.Name = "frmValidateAddress"
        Me.ShowInTaskbar = False
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent
        Me.Text = "Validate Address"
        CType(Me.dgvSuggestedAddresses, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.dgvErrors, System.ComponentModel.ISupportInitialize).EndInit()
        Me.gbAddressDetails.ResumeLayout(False)
        Me.gbAddressDetails.PerformLayout()
        Me.gcClientInfo.ResumeLayout(False)
        Me.gcClientInfo.PerformLayout()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents btnSubmit As System.Windows.Forms.Button
    Friend WithEvents txtCountry As System.Windows.Forms.TextBox
    Friend WithEvents lblCountry As System.Windows.Forms.Label
    Friend WithEvents txtState As System.Windows.Forms.TextBox
    Friend WithEvents lblState As System.Windows.Forms.Label
    Friend WithEvents txtPostCode As System.Windows.Forms.TextBox
    Friend WithEvents lblPostCode As System.Windows.Forms.Label
    Friend WithEvents txtCity As System.Windows.Forms.TextBox
    Friend WithEvents lblCity As System.Windows.Forms.Label
    Friend WithEvents txtLine3 As System.Windows.Forms.TextBox
    Friend WithEvents lblSuggestedAddresses As System.Windows.Forms.Label
    Friend WithEvents lblErrors As System.Windows.Forms.Label
    Friend WithEvents dgvSuggestedAddresses As System.Windows.Forms.DataGridView
    Friend WithEvents dgvErrors As System.Windows.Forms.DataGridView
    Friend WithEvents lblLine3 As System.Windows.Forms.Label
    Friend WithEvents txtLine2 As System.Windows.Forms.TextBox
    Friend WithEvents lblLine2 As System.Windows.Forms.Label
    Friend WithEvents txtLine1 As System.Windows.Forms.TextBox
    Friend WithEvents btnCancel As System.Windows.Forms.Button
    Friend WithEvents lblLine1 As System.Windows.Forms.Label
    Friend WithEvents gbAddressDetails As System.Windows.Forms.GroupBox
    Friend WithEvents gcClientInfo As System.Windows.Forms.GroupBox
    Friend WithEvents lblVersion As System.Windows.Forms.Label
    Friend WithEvents lblAccountEntity As System.Windows.Forms.Label
    Friend WithEvents lblAccountCountry As System.Windows.Forms.Label
    Friend WithEvents lblAccountPin As System.Windows.Forms.Label
    Friend WithEvents lblAccountNumber As System.Windows.Forms.Label
    Friend WithEvents lblPassword As System.Windows.Forms.Label
    Friend WithEvents lblUsername As System.Windows.Forms.Label
    Friend WithEvents txtVersion As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountEntity As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountCountryCode As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountPin As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountNumber As System.Windows.Forms.TextBox
    Friend WithEvents txtPassword As System.Windows.Forms.TextBox
    Friend WithEvents txtUsername As System.Windows.Forms.TextBox

End Class
