<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class frmFetchCountry
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
        Me.lblAccountCountry = New System.Windows.Forms.Label()
        Me.lblAccountNumber = New System.Windows.Forms.Label()
        Me.lblPassword = New System.Windows.Forms.Label()
        Me.lblUsername = New System.Windows.Forms.Label()
        Me.txtVersion = New System.Windows.Forms.TextBox()
        Me.lblAccountPin = New System.Windows.Forms.Label()
        Me.txtAccountEntity = New System.Windows.Forms.TextBox()
        Me.txtAccountCountryCode = New System.Windows.Forms.TextBox()
        Me.txtAccountPin = New System.Windows.Forms.TextBox()
        Me.txtAccountNumber = New System.Windows.Forms.TextBox()
        Me.txtUsername = New System.Windows.Forms.TextBox()
        Me.txtCountryCode = New System.Windows.Forms.TextBox()
        Me.lblVersion = New System.Windows.Forms.Label()
        Me.gcClientInfo = New System.Windows.Forms.GroupBox()
        Me.lblAccountEntity = New System.Windows.Forms.Label()
        Me.txtPassword = New System.Windows.Forms.TextBox()
        Me.gbCountries = New System.Windows.Forms.GroupBox()
        Me.lblCountryCode = New System.Windows.Forms.Label()
        Me.btnCancel = New System.Windows.Forms.Button()
        Me.lblCountries = New System.Windows.Forms.Label()
        Me.lblErrors = New System.Windows.Forms.Label()
        Me.dgvCountries = New System.Windows.Forms.DataGridView()
        Me.dgvErrors = New System.Windows.Forms.DataGridView()
        Me.btnSubmit = New System.Windows.Forms.Button()
        Me.gcClientInfo.SuspendLayout()
        Me.gbCountries.SuspendLayout()
        CType(Me.dgvCountries, System.ComponentModel.ISupportInitialize).BeginInit()
        CType(Me.dgvErrors, System.ComponentModel.ISupportInitialize).BeginInit()
        Me.SuspendLayout()
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
        'lblAccountPin
        '
        Me.lblAccountPin.AutoSize = True
        Me.lblAccountPin.Location = New System.Drawing.Point(6, 96)
        Me.lblAccountPin.Name = "lblAccountPin"
        Me.lblAccountPin.Size = New System.Drawing.Size(49, 13)
        Me.lblAccountPin.TabIndex = 6
        Me.lblAccountPin.Text = "Acc. Pin:"
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
        'txtUsername
        '
        Me.txtUsername.Location = New System.Drawing.Point(89, 14)
        Me.txtUsername.Name = "txtUsername"
        Me.txtUsername.Size = New System.Drawing.Size(167, 20)
        Me.txtUsername.TabIndex = 1
        Me.txtUsername.Text = "reem@reem.com"
        '
        'txtCountryCode
        '
        Me.txtCountryCode.Location = New System.Drawing.Point(87, 14)
        Me.txtCountryCode.MaxLength = 100
        Me.txtCountryCode.Name = "txtCountryCode"
        Me.txtCountryCode.Size = New System.Drawing.Size(167, 20)
        Me.txtCountryCode.TabIndex = 1
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
        Me.gcClientInfo.Location = New System.Drawing.Point(10, 17)
        Me.gcClientInfo.Name = "gcClientInfo"
        Me.gcClientInfo.Size = New System.Drawing.Size(278, 198)
        Me.gcClientInfo.TabIndex = 22
        Me.gcClientInfo.TabStop = False
        Me.gcClientInfo.Text = "ClientInfo"
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
        'txtPassword
        '
        Me.txtPassword.Location = New System.Drawing.Point(89, 40)
        Me.txtPassword.Name = "txtPassword"
        Me.txtPassword.Size = New System.Drawing.Size(167, 20)
        Me.txtPassword.TabIndex = 3
        Me.txtPassword.Text = "123456789"
        '
        'gbCountries
        '
        Me.gbCountries.Controls.Add(Me.txtCountryCode)
        Me.gbCountries.Controls.Add(Me.lblCountryCode)
        Me.gbCountries.Location = New System.Drawing.Point(296, 17)
        Me.gbCountries.Name = "gbCountries"
        Me.gbCountries.Size = New System.Drawing.Size(265, 198)
        Me.gbCountries.TabIndex = 15
        Me.gbCountries.TabStop = False
        Me.gbCountries.Text = "Search Criteria"
        '
        'lblCountryCode
        '
        Me.lblCountryCode.AutoSize = True
        Me.lblCountryCode.Location = New System.Drawing.Point(6, 18)
        Me.lblCountryCode.Name = "lblCountryCode"
        Me.lblCountryCode.Size = New System.Drawing.Size(78, 13)
        Me.lblCountryCode.TabIndex = 0
        Me.lblCountryCode.Text = "Country Code:"
        '
        'btnCancel
        '
        Me.btnCancel.DialogResult = System.Windows.Forms.DialogResult.Cancel
        Me.btnCancel.Location = New System.Drawing.Point(487, 525)
        Me.btnCancel.Name = "btnCancel"
        Me.btnCancel.Size = New System.Drawing.Size(75, 23)
        Me.btnCancel.TabIndex = 21
        Me.btnCancel.Text = "Cancel"
        Me.btnCancel.UseVisualStyleBackColor = True
        '
        'lblCountries
        '
        Me.lblCountries.AutoSize = True
        Me.lblCountries.Location = New System.Drawing.Point(13, 376)
        Me.lblCountries.Name = "lblCountries"
        Me.lblCountries.Size = New System.Drawing.Size(53, 13)
        Me.lblCountries.TabIndex = 18
        Me.lblCountries.Text = "Countries"
        '
        'lblErrors
        '
        Me.lblErrors.AutoSize = True
        Me.lblErrors.Location = New System.Drawing.Point(13, 229)
        Me.lblErrors.Name = "lblErrors"
        Me.lblErrors.Size = New System.Drawing.Size(74, 13)
        Me.lblErrors.TabIndex = 16
        Me.lblErrors.Text = "Errors (if any)"
        '
        'dgvCountries
        '
        Me.dgvCountries.AllowUserToAddRows = False
        Me.dgvCountries.AllowUserToDeleteRows = False
        Me.dgvCountries.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize
        Me.dgvCountries.Location = New System.Drawing.Point(10, 392)
        Me.dgvCountries.Name = "dgvCountries"
        Me.dgvCountries.ReadOnly = True
        Me.dgvCountries.Size = New System.Drawing.Size(550, 127)
        Me.dgvCountries.TabIndex = 19
        '
        'dgvErrors
        '
        Me.dgvErrors.AllowUserToAddRows = False
        Me.dgvErrors.AllowUserToDeleteRows = False
        Me.dgvErrors.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize
        Me.dgvErrors.Location = New System.Drawing.Point(11, 247)
        Me.dgvErrors.Name = "dgvErrors"
        Me.dgvErrors.ReadOnly = True
        Me.dgvErrors.Size = New System.Drawing.Size(550, 127)
        Me.dgvErrors.TabIndex = 17
        '
        'btnSubmit
        '
        Me.btnSubmit.Location = New System.Drawing.Point(406, 525)
        Me.btnSubmit.Name = "btnSubmit"
        Me.btnSubmit.Size = New System.Drawing.Size(75, 23)
        Me.btnSubmit.TabIndex = 20
        Me.btnSubmit.Text = "Submit"
        Me.btnSubmit.UseVisualStyleBackColor = True
        '
        'frmFetchCountry
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(572, 564)
        Me.Controls.Add(Me.gcClientInfo)
        Me.Controls.Add(Me.gbCountries)
        Me.Controls.Add(Me.btnCancel)
        Me.Controls.Add(Me.lblCountries)
        Me.Controls.Add(Me.lblErrors)
        Me.Controls.Add(Me.dgvCountries)
        Me.Controls.Add(Me.dgvErrors)
        Me.Controls.Add(Me.btnSubmit)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.Name = "frmFetchCountry"
        Me.ShowInTaskbar = False
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent
        Me.Text = "Fetch Country"
        Me.gcClientInfo.ResumeLayout(False)
        Me.gcClientInfo.PerformLayout()
        Me.gbCountries.ResumeLayout(False)
        Me.gbCountries.PerformLayout()
        CType(Me.dgvCountries, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.dgvErrors, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents lblAccountCountry As System.Windows.Forms.Label
    Friend WithEvents lblAccountNumber As System.Windows.Forms.Label
    Friend WithEvents lblPassword As System.Windows.Forms.Label
    Friend WithEvents lblUsername As System.Windows.Forms.Label
    Friend WithEvents txtVersion As System.Windows.Forms.TextBox
    Friend WithEvents lblAccountPin As System.Windows.Forms.Label
    Friend WithEvents txtAccountEntity As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountCountryCode As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountPin As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountNumber As System.Windows.Forms.TextBox
    Friend WithEvents txtUsername As System.Windows.Forms.TextBox
    Friend WithEvents txtCountryCode As System.Windows.Forms.TextBox
    Friend WithEvents lblVersion As System.Windows.Forms.Label
    Friend WithEvents gcClientInfo As System.Windows.Forms.GroupBox
    Friend WithEvents lblAccountEntity As System.Windows.Forms.Label
    Friend WithEvents txtPassword As System.Windows.Forms.TextBox
    Friend WithEvents gbCountries As System.Windows.Forms.GroupBox
    Friend WithEvents lblCountryCode As System.Windows.Forms.Label
    Friend WithEvents btnCancel As System.Windows.Forms.Button
    Friend WithEvents lblCountries As System.Windows.Forms.Label
    Friend WithEvents lblErrors As System.Windows.Forms.Label
    Friend WithEvents dgvCountries As System.Windows.Forms.DataGridView
    Friend WithEvents dgvErrors As System.Windows.Forms.DataGridView
    Friend WithEvents btnSubmit As System.Windows.Forms.Button
End Class
