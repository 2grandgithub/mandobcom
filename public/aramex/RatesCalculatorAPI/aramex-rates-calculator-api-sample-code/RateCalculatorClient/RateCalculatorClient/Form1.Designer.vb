<Global.Microsoft.VisualBasic.CompilerServices.DesignerGenerated()> _
Partial Class Form1
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
        Me.components = New System.ComponentModel.Container()
        Dim resources As System.ComponentModel.ComponentResourceManager = New System.ComponentModel.ComponentResourceManager(GetType(Form1))
        Me.gbCases = New System.Windows.Forms.GroupBox()
        Me.btnInvoke = New System.Windows.Forms.Button()
        Me.lblDescription = New System.Windows.Forms.Label()
        Me.txtDescription = New System.Windows.Forms.TextBox()
        Me.cmbCases = New System.Windows.Forms.ComboBox()
        Me.gbInputRequest = New System.Windows.Forms.GroupBox()
        Me.tvInputRequest = New System.Windows.Forms.TreeView()
        Me.gbOutputRequest = New System.Windows.Forms.GroupBox()
        Me.tvOutputRequest = New System.Windows.Forms.TreeView()
        Me.btnExit = New System.Windows.Forms.Button()
        Me.imgList = New System.Windows.Forms.ImageList(Me.components)
        Me.gbCases.SuspendLayout()
        Me.gbInputRequest.SuspendLayout()
        Me.gbOutputRequest.SuspendLayout()
        Me.SuspendLayout()
        '
        'gbCases
        '
        Me.gbCases.Controls.Add(Me.btnInvoke)
        Me.gbCases.Controls.Add(Me.lblDescription)
        Me.gbCases.Controls.Add(Me.txtDescription)
        Me.gbCases.Controls.Add(Me.cmbCases)
        Me.gbCases.Location = New System.Drawing.Point(12, 12)
        Me.gbCases.Name = "gbCases"
        Me.gbCases.Size = New System.Drawing.Size(653, 192)
        Me.gbCases.TabIndex = 0
        Me.gbCases.TabStop = False
        Me.gbCases.Text = "Testing Scenarios"
        '
        'btnInvoke
        '
        Me.btnInvoke.Location = New System.Drawing.Point(572, 17)
        Me.btnInvoke.Name = "btnInvoke"
        Me.btnInvoke.Size = New System.Drawing.Size(75, 23)
        Me.btnInvoke.TabIndex = 1
        Me.btnInvoke.Text = "Invoke"
        Me.btnInvoke.UseVisualStyleBackColor = True
        '
        'lblDescription
        '
        Me.lblDescription.AutoSize = True
        Me.lblDescription.Location = New System.Drawing.Point(6, 49)
        Me.lblDescription.Name = "lblDescription"
        Me.lblDescription.Size = New System.Drawing.Size(63, 13)
        Me.lblDescription.TabIndex = 2
        Me.lblDescription.Text = "Description:"
        '
        'txtDescription
        '
        Me.txtDescription.BackColor = System.Drawing.SystemColors.Window
        Me.txtDescription.Location = New System.Drawing.Point(6, 65)
        Me.txtDescription.Multiline = True
        Me.txtDescription.Name = "txtDescription"
        Me.txtDescription.ReadOnly = True
        Me.txtDescription.ScrollBars = System.Windows.Forms.ScrollBars.Vertical
        Me.txtDescription.Size = New System.Drawing.Size(641, 121)
        Me.txtDescription.TabIndex = 3
        '
        'cmbCases
        '
        Me.cmbCases.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList
        Me.cmbCases.FormattingEnabled = True
        Me.cmbCases.Location = New System.Drawing.Point(6, 19)
        Me.cmbCases.Name = "cmbCases"
        Me.cmbCases.Size = New System.Drawing.Size(560, 21)
        Me.cmbCases.TabIndex = 0
        '
        'gbInputRequest
        '
        Me.gbInputRequest.Controls.Add(Me.tvInputRequest)
        Me.gbInputRequest.Location = New System.Drawing.Point(12, 210)
        Me.gbInputRequest.Name = "gbInputRequest"
        Me.gbInputRequest.Size = New System.Drawing.Size(325, 325)
        Me.gbInputRequest.TabIndex = 1
        Me.gbInputRequest.TabStop = False
        Me.gbInputRequest.Text = "Input Request"
        '
        'tvInputRequest
        '
        Me.tvInputRequest.Dock = System.Windows.Forms.DockStyle.Fill
        Me.tvInputRequest.ImageIndex = 0
        Me.tvInputRequest.ImageList = Me.imgList
        Me.tvInputRequest.Location = New System.Drawing.Point(3, 16)
        Me.tvInputRequest.Name = "tvInputRequest"
        Me.tvInputRequest.SelectedImageIndex = 0
        Me.tvInputRequest.Size = New System.Drawing.Size(319, 306)
        Me.tvInputRequest.TabIndex = 0
        '
        'gbOutputRequest
        '
        Me.gbOutputRequest.Controls.Add(Me.tvOutputRequest)
        Me.gbOutputRequest.Location = New System.Drawing.Point(343, 210)
        Me.gbOutputRequest.Name = "gbOutputRequest"
        Me.gbOutputRequest.Size = New System.Drawing.Size(325, 325)
        Me.gbOutputRequest.TabIndex = 2
        Me.gbOutputRequest.TabStop = False
        Me.gbOutputRequest.Text = "Output Request"
        '
        'tvOutputRequest
        '
        Me.tvOutputRequest.Dock = System.Windows.Forms.DockStyle.Fill
        Me.tvOutputRequest.ImageIndex = 1
        Me.tvOutputRequest.ImageList = Me.imgList
        Me.tvOutputRequest.Location = New System.Drawing.Point(3, 16)
        Me.tvOutputRequest.Name = "tvOutputRequest"
        Me.tvOutputRequest.SelectedImageIndex = 1
        Me.tvOutputRequest.Size = New System.Drawing.Size(319, 306)
        Me.tvOutputRequest.TabIndex = 0
        '
        'btnExit
        '
        Me.btnExit.Location = New System.Drawing.Point(593, 541)
        Me.btnExit.Name = "btnExit"
        Me.btnExit.Size = New System.Drawing.Size(75, 23)
        Me.btnExit.TabIndex = 5
        Me.btnExit.Text = "Exit"
        Me.btnExit.UseVisualStyleBackColor = True
        '
        'imgList
        '
        Me.imgList.ImageStream = CType(resources.GetObject("imgList.ImageStream"), System.Windows.Forms.ImageListStreamer)
        Me.imgList.TransparentColor = System.Drawing.Color.Transparent
        Me.imgList.Images.SetKeyName(0, "1300368068_old-edit-redo.png")
        Me.imgList.Images.SetKeyName(1, "1300368161_old-edit-undo.png")
        '
        'Form1
        '
        Me.AutoScaleDimensions = New System.Drawing.SizeF(6.0!, 13.0!)
        Me.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font
        Me.ClientSize = New System.Drawing.Size(681, 570)
        Me.Controls.Add(Me.btnExit)
        Me.Controls.Add(Me.gbOutputRequest)
        Me.Controls.Add(Me.gbInputRequest)
        Me.Controls.Add(Me.gbCases)
        Me.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle
        Me.MaximizeBox = False
        Me.Name = "Form1"
        Me.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen
        Me.Text = "Rate Calculator Client"
        Me.gbCases.ResumeLayout(False)
        Me.gbCases.PerformLayout()
        Me.gbInputRequest.ResumeLayout(False)
        Me.gbOutputRequest.ResumeLayout(False)
        Me.ResumeLayout(False)

    End Sub
    Friend WithEvents gbCases As System.Windows.Forms.GroupBox
    Friend WithEvents cmbCases As System.Windows.Forms.ComboBox
    Friend WithEvents lblDescription As System.Windows.Forms.Label
    Friend WithEvents txtDescription As System.Windows.Forms.TextBox
    Friend WithEvents btnInvoke As System.Windows.Forms.Button
    Friend WithEvents gbInputRequest As System.Windows.Forms.GroupBox
    Friend WithEvents tvInputRequest As System.Windows.Forms.TreeView
    Friend WithEvents gbOutputRequest As System.Windows.Forms.GroupBox
    Friend WithEvents tvOutputRequest As System.Windows.Forms.TreeView
    Friend WithEvents btnExit As System.Windows.Forms.Button
    Friend WithEvents imgList As System.Windows.Forms.ImageList

End Class
