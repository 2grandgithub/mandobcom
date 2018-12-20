namespace RateCalculatorClient
{
    partial class Form1
    {
        /// <summary>
        /// Required designer variable.
        /// </summary>
        private System.ComponentModel.IContainer components = null;

        /// <summary>
        /// Clean up any resources being used.
        /// </summary>
        /// <param name="disposing">true if managed resources should be disposed; otherwise, false.</param>
        protected override void Dispose(bool disposing)
        {
            if (disposing && (components != null))
            {
                components.Dispose();
            }
            base.Dispose(disposing);
        }

        #region Windows Form Designer generated code

        /// <summary>
        /// Required method for Designer support - do not modify
        /// the contents of this method with the code editor.
        /// </summary>
        private void InitializeComponent()
        {
            this.components = new System.ComponentModel.Container();
            System.ComponentModel.ComponentResourceManager resources = new System.ComponentModel.ComponentResourceManager(typeof(Form1));
            this.gbCases = new System.Windows.Forms.GroupBox();
            this.txtDescription = new System.Windows.Forms.TextBox();
            this.lblDescription = new System.Windows.Forms.Label();
            this.btnInvoke = new System.Windows.Forms.Button();
            this.cmbCases = new System.Windows.Forms.ComboBox();
            this.gbInputRequest = new System.Windows.Forms.GroupBox();
            this.tvInputRequest = new System.Windows.Forms.TreeView();
            this.gbOutputRequest = new System.Windows.Forms.GroupBox();
            this.tvOutputRequest = new System.Windows.Forms.TreeView();
            this.btnExit = new System.Windows.Forms.Button();
            this.imgList = new System.Windows.Forms.ImageList(this.components);
            this.gbCases.SuspendLayout();
            this.gbInputRequest.SuspendLayout();
            this.gbOutputRequest.SuspendLayout();
            this.SuspendLayout();
            // 
            // gbCases
            // 
            this.gbCases.Controls.Add(this.txtDescription);
            this.gbCases.Controls.Add(this.lblDescription);
            this.gbCases.Controls.Add(this.btnInvoke);
            this.gbCases.Controls.Add(this.cmbCases);
            this.gbCases.Location = new System.Drawing.Point(12, 12);
            this.gbCases.Name = "gbCases";
            this.gbCases.Size = new System.Drawing.Size(653, 192);
            this.gbCases.TabIndex = 0;
            this.gbCases.TabStop = false;
            this.gbCases.Text = "Testing Scenarios";
            // 
            // txtDescription
            // 
            this.txtDescription.Location = new System.Drawing.Point(6, 65);
            this.txtDescription.Multiline = true;
            this.txtDescription.Name = "txtDescription";
            this.txtDescription.Size = new System.Drawing.Size(641, 121);
            this.txtDescription.TabIndex = 3;
            // 
            // lblDescription
            // 
            this.lblDescription.AutoSize = true;
            this.lblDescription.Location = new System.Drawing.Point(6, 49);
            this.lblDescription.Name = "lblDescription";
            this.lblDescription.Size = new System.Drawing.Size(63, 13);
            this.lblDescription.TabIndex = 2;
            this.lblDescription.Text = "Description:";
            // 
            // btnInvoke
            // 
            this.btnInvoke.Location = new System.Drawing.Point(572, 17);
            this.btnInvoke.Name = "btnInvoke";
            this.btnInvoke.Size = new System.Drawing.Size(75, 23);
            this.btnInvoke.TabIndex = 1;
            this.btnInvoke.Text = "Invoke";
            this.btnInvoke.UseVisualStyleBackColor = true;
            this.btnInvoke.Click += new System.EventHandler(this.btnInvoke_Click);
            // 
            // cmbCases
            // 
            this.cmbCases.DropDownStyle = System.Windows.Forms.ComboBoxStyle.DropDownList;
            this.cmbCases.FormattingEnabled = true;
            this.cmbCases.Location = new System.Drawing.Point(6, 19);
            this.cmbCases.Name = "cmbCases";
            this.cmbCases.Size = new System.Drawing.Size(560, 21);
            this.cmbCases.TabIndex = 0;
            this.cmbCases.SelectedIndexChanged += new System.EventHandler(this.cmbCases_SelectedIndexChanged);
            // 
            // gbInputRequest
            // 
            this.gbInputRequest.Controls.Add(this.tvInputRequest);
            this.gbInputRequest.Location = new System.Drawing.Point(12, 210);
            this.gbInputRequest.Name = "gbInputRequest";
            this.gbInputRequest.Size = new System.Drawing.Size(325, 325);
            this.gbInputRequest.TabIndex = 1;
            this.gbInputRequest.TabStop = false;
            this.gbInputRequest.Text = "Input Request";
            // 
            // tvInputRequest
            // 
            this.tvInputRequest.Dock = System.Windows.Forms.DockStyle.Fill;
            this.tvInputRequest.ImageIndex = 0;
            this.tvInputRequest.ImageList = this.imgList;
            this.tvInputRequest.Location = new System.Drawing.Point(3, 16);
            this.tvInputRequest.Name = "tvInputRequest";
            this.tvInputRequest.SelectedImageIndex = 0;
            this.tvInputRequest.Size = new System.Drawing.Size(319, 306);
            this.tvInputRequest.TabIndex = 0;
            // 
            // gbOutputRequest
            // 
            this.gbOutputRequest.Controls.Add(this.tvOutputRequest);
            this.gbOutputRequest.Location = new System.Drawing.Point(343, 210);
            this.gbOutputRequest.Name = "gbOutputRequest";
            this.gbOutputRequest.Size = new System.Drawing.Size(325, 325);
            this.gbOutputRequest.TabIndex = 2;
            this.gbOutputRequest.TabStop = false;
            this.gbOutputRequest.Text = "Output Request";
            // 
            // tvOutputRequest
            // 
            this.tvOutputRequest.Dock = System.Windows.Forms.DockStyle.Fill;
            this.tvOutputRequest.ImageIndex = 1;
            this.tvOutputRequest.ImageList = this.imgList;
            this.tvOutputRequest.Location = new System.Drawing.Point(3, 16);
            this.tvOutputRequest.Name = "tvOutputRequest";
            this.tvOutputRequest.SelectedImageIndex = 1;
            this.tvOutputRequest.Size = new System.Drawing.Size(319, 306);
            this.tvOutputRequest.TabIndex = 0;
            // 
            // btnExit
            // 
            this.btnExit.Location = new System.Drawing.Point(590, 538);
            this.btnExit.Name = "btnExit";
            this.btnExit.Size = new System.Drawing.Size(75, 23);
            this.btnExit.TabIndex = 3;
            this.btnExit.Text = "Exit";
            this.btnExit.UseVisualStyleBackColor = true;
            this.btnExit.Click += new System.EventHandler(this.btnExit_Click);
            // 
            // imgList
            // 
            this.imgList.ImageStream = ((System.Windows.Forms.ImageListStreamer)(resources.GetObject("imgList.ImageStream")));
            this.imgList.TransparentColor = System.Drawing.Color.Transparent;
            this.imgList.Images.SetKeyName(0, "1300368068_old-edit-redo.png");
            this.imgList.Images.SetKeyName(1, "1300368161_old-edit-undo.png");
            // 
            // Form1
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(671, 565);
            this.Controls.Add(this.btnExit);
            this.Controls.Add(this.gbOutputRequest);
            this.Controls.Add(this.gbInputRequest);
            this.Controls.Add(this.gbCases);
            this.MaximizeBox = false;
            this.Name = "Form1";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Rate Calculator Client";
            this.Load += new System.EventHandler(this.Form1_Load);
            this.gbCases.ResumeLayout(false);
            this.gbCases.PerformLayout();
            this.gbInputRequest.ResumeLayout(false);
            this.gbOutputRequest.ResumeLayout(false);
            this.ResumeLayout(false);

        }

        #endregion

        private System.Windows.Forms.GroupBox gbCases;
        private System.Windows.Forms.ComboBox cmbCases;
        private System.Windows.Forms.TextBox txtDescription;
        private System.Windows.Forms.Label lblDescription;
        private System.Windows.Forms.Button btnInvoke;
        private System.Windows.Forms.GroupBox gbInputRequest;
        private System.Windows.Forms.TreeView tvInputRequest;
        private System.Windows.Forms.GroupBox gbOutputRequest;
        private System.Windows.Forms.TreeView tvOutputRequest;
        private System.Windows.Forms.Button btnExit;
        internal System.Windows.Forms.ImageList imgList;



    }
}

