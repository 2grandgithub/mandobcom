<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class frmFetchCities
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
        Me.lblCityName = New System.Windows.Forms.Label()
        Me.txtState = New System.Windows.Forms.TextBox()
        Me.lblState = New System.Windows.Forms.Label()
        Me.lblAccountPin = New System.Windows.Forms.Label()
        Me.txtAccountEntity = New System.Windows.Forms.TextBox()
        Me.txtAccountCountryCode = New System.Windows.Forms.TextBox()
        Me.txtAccountPin = New System.Windows.Forms.TextBox()
        Me.txtCityName = New System.Windows.Forms.TextBox()
        Me.txtAccountNumber = New System.Windows.Forms.TextBox()
        Me.txtUsername = New System.Windows.Forms.TextBox()
        Me.txtCountryCode = New System.Windows.Forms.TextBox()
        Me.lblVersion = New System.Windows.Forms.Label()
        Me.gcClientInfo = New System.Windows.Forms.GroupBox()
        Me.lblAccountEntity = New System.Windows.Forms.Label()
        Me.txtPassword = New System.Windows.Forms.TextBox()
        Me.gbSearchCriteria = New System.Windows.Forms.GroupBox()
        Me.lblCountryCode = New System.Windows.Forms.Label()
        Me.btnCancel = New System.Windows.Forms.Button()
        Me.lblCities = New System.Windows.Forms.Label()
        Me.lblErrors = New System.Windows.Forms.Label()
        Me.dgvCities = New System.Windows.Forms.DataGridView()
        Me.dgvErrors = New System.Windows.Forms.DataGridView()
        Me.btnSubmit = New System.Windows.Forms.Button()
        Me.gcClientInfo.SuspendLayout()
        Me.gbSearchCriteria.SuspendLayout()
        CType(Me.dgvCities, System.ComponentModel.ISupportInitialize).BeginInit()
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
        'lblCityName
        '
        Me.lblCityName.AutoSize = True
        Me.lblCityName.Location = New System.Drawing.Point(6, 70)
        Me.lblCityName.Name = "lblCityName"
        Me.lblCityName.Size = New System.Drawing.Size(38, 13)
        Me.lblCityName.TabIndex = 4
        Me.lblCityName.Text = "Name:"
        '
        'txtState
        '
        Me.txtState.Location = New System.Drawing.Point(87, 40)
        Me.txtState.MaxLength = 100
        Me.txtState.Name = "txtState"
        Me.txtState.Size = New System.Drawing.Size(167, 20)
        Me.txtState.TabIndex = 3
        '
        'lblState
        '
        Me.lblState.AutoSize = True
        Me.lblState.Location = New System.Drawing.Point(6, 43)
        Me.lblState.Name = "lblState"
        Me.lblState.Size = New System.Drawing.Size(37, 13)
        Me.lblState.TabIndex = 2
        Me.lblState.Text = "State:"
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
        'txtCityName
        '
        Me.txtCityName.Location = New System.Drawing.Point(87, 66)
        Me.txtCityName.MaxLength = 100
        Me.txtCityName.Name = "txtCityName"
        Me.txtCityName.Size = New System.Drawing.Size(167, 20)
        Me.txtCityName.TabIndex = 5
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
        Me.gcClientInfo.TabIndex = 0
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
        'gbSearchCriteria
        '
        Me.gbSearchCriteria.Controls.Add(Me.txtCityName)
        Me.gbSearchCriteria.Controls.Add(Me.lblCityName)
        Me.gbSearchCriteria.Controls.Add(Me.txtState)
        Me.gbSearchCriteria.Controls.Add(Me.lblState)
        Me.gbSearchCriteria.Controls.Add(Me.txtCountryCode)
        Me.gbSearchCriteria.Controls.Add(Me.lblCountryCode)
        Me.gbSearchCriteria.Location = New System.Drawing.Point(296, 17)
        Me.gbSearchCriteria.Name = "gbSearchCriteria"
        Me.gbSearchCriteria.Size = New System.Drawing.Size(265, 198)
        Me.gbSearchCriteria.TabIndex = 1
        Me.gbSearchCriteria.TabStop = False
        Me.gbSearchCriteria.Text = "Search Criteria"
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
        Me.btnCancel.TabIndex = 7
        Me.btnCancel.Text = "Cancel"
        Me.btnCancel.UseVisualStyleBackColor = True
        '
        'lblCities
        '
        Me.lblCities.AutoSize = True
        Me.lblCities.Location = New System.Drawing.Point(13, 376)
        Me.lblCities.Name = "lblCities"
        Me.lblCities.Size = New System.Drawing.Size(33, 13)
        Me.lblCities.TabIndex = 4
        Me.lblCities.Text = "Cities"
        '
        'lblErrors
        '
        Me.lblErrors.AutoSize = True
        Me.lblErrors.Location = New System.Drawing.Point(13, 229)
        Me.lblErrors.Name = "lblErrors"
        Me.lblErrors.Size = New System.Drawing.Size(74, 13)
        Me.lblErrors.TabIndex = 2
        Me.lblErrors.Text = "Errors (if any)"
        '
        'dgvCities
        '
        Me.dgvCities.AllowUserToAddRows = False
        Me.dgvCities.AllowUserToDeleteRows = False
        Me.dgvCities.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize
        Me.dgvCities.Location = New System.Drawing.Point(10, 392)
        Me.dgvCities.Name = "dgvCities"
        Me.dgvCities.ReadOnly = True
        Me.dgvCities.Size = New System.Drawing.Size(550, 127)
        Me.dgvCities.TabIndex = 5
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
        Me.dgvErrors.TabIndex = 3
        '
        'btnSubmit
        '
        Me.btnSubmit.Location = New System.Drawing.Point(406, 525)
        Me.btnSubmit.Name = "btnSubmit"
        Me.btnSubmit.Size = New System.Drawing.Size(75, 23)
        Me.btnSubmit.TabIndex = 6
        Me.btnSubmit.Text = "Submit"
        Me.btnSubmit.UseVisualStyleBackColor = True
        '
        'frmFetchCities
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(572, 564)
        Me.Controls.Add(Me.gcClientInfo)
        Me.Controls.Add(Me.gbSearchCriteria)
        Me.Controls.Add(Me.btnCancel)
        Me.Controls.Add(Me.lblCities)
        Me.Controls.Add(Me.lblErrors)
        Me.Controls.Add(Me.dgvCities)
        Me.Controls.Add(Me.dgvErrors)
        Me.Controls.Add(Me.btnSubmit)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.MaximizeBox = False
        Me.MinimizeBox = False
        Me.Name = "frmFetchCities"
        Me.ShowInTaskbar = False
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent
        Me.Text = "Fetch Cities"
        Me.gcClientInfo.ResumeLayout(False)
        Me.gcClientInfo.PerformLayout()
        Me.gbSearchCriteria.ResumeLayout(False)
        Me.gbSearchCriteria.PerformLayout()
        CType(Me.dgvCities, System.ComponentModel.ISupportInitialize).EndInit()
        CType(Me.dgvErrors, System.ComponentModel.ISupportInitialize).EndInit()
        Me.ResumeLayout(False)
        Me.PerformLayout()

    End Sub
    Friend WithEvents lblAccountCountry As System.Windows.Forms.Label
    Friend WithEvents lblAccountNumber As System.Windows.Forms.Label
    Friend WithEvents lblPassword As System.Windows.Forms.Label
    Friend WithEvents lblUsername As System.Windows.Forms.Label
    Friend WithEvents txtVersion As System.Windows.Forms.TextBox
    Friend WithEvents lblCityName As System.Windows.Forms.Label
    Friend WithEvents txtState As System.Windows.Forms.TextBox
    Friend WithEvents lblAccountPin As System.Windows.Forms.Label
    Friend WithEvents txtAccountEntity As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountCountryCode As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountPin As System.Windows.Forms.TextBox
    Friend WithEvents lblState As System.Windows.Forms.Label
    Friend WithEvents txtCityName As System.Windows.Forms.TextBox
    Friend WithEvents txtAccountNumber As System.Windows.Forms.TextBox
    Friend WithEvents txtUsername As System.Windows.Forms.TextBox
    Friend WithEvents txtCountryCode As System.Windows.Forms.TextBox
    Friend WithEvents lblVersion As System.Windows.Forms.Label
    Friend WithEvents gcClientInfo As System.Windows.Forms.GroupBox
    Friend WithEvents lblAccountEntity As System.Windows.Forms.Label
    Friend WithEvents txtPassword As System.Windows.Forms.TextBox
    Friend WithEvents gbSearchCriteria As System.Windows.Forms.GroupBox
    Friend WithEvents lblCountryCode As System.Windows.Forms.Label
    Friend WithEvents btnCancel As System.Windows.Forms.Button
    Friend WithEvents lblCities As System.Windows.Forms.Label
    Friend WithEvents lblErrors As System.Windows.Forms.Label
    Friend WithEvents dgvCities As System.Windows.Forms.DataGridView
    Friend WithEvents dgvErrors As System.Windows.Forms.DataGridView
    Friend WithEvents btnSubmit As System.Windows.Forms.Button
End Class
