namespace LocationAPIClientCSharp
{
    partial class frmFetchCountries
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
            this.btnCancel = new System.Windows.Forms.Button();
            this.lblCountries = new System.Windows.Forms.Label();
            this.lblErrors = new System.Windows.Forms.Label();
            this.gdvCountries = new System.Windows.Forms.DataGridView();
            this.btnSubmit = new System.Windows.Forms.Button();
            this.lblAccountEntity = new System.Windows.Forms.Label();
            this.gcClientInfo = new System.Windows.Forms.GroupBox();
            this.lblVersion = new System.Windows.Forms.Label();
            this.lblAccountCountry = new System.Windows.Forms.Label();
            this.lblAccountPin = new System.Windows.Forms.Label();
            this.lblAccountNumber = new System.Windows.Forms.Label();
            this.lblPassword = new System.Windows.Forms.Label();
            this.lblUsername = new System.Windows.Forms.Label();
            this.txtVersion = new System.Windows.Forms.TextBox();
            this.txtAccountEntity = new System.Windows.Forms.TextBox();
            this.txtAccountCountryCode = new System.Windows.Forms.TextBox();
            this.txtAccountPin = new System.Windows.Forms.TextBox();
            this.txtAccountNumber = new System.Windows.Forms.TextBox();
            this.txtPassword = new System.Windows.Forms.TextBox();
            this.txtUsername = new System.Windows.Forms.TextBox();
            this.dgvErrors = new System.Windows.Forms.DataGridView();
            ((System.ComponentModel.ISupportInitialize)(this.gdvCountries)).BeginInit();
            this.gcClientInfo.SuspendLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvErrors)).BeginInit();
            this.SuspendLayout();
            // 
            // btnCancel
            // 
            this.btnCancel.DialogResult = System.Windows.Forms.DialogResult.Cancel;
            this.btnCancel.Location = new System.Drawing.Point(487, 525);
            this.btnCancel.Name = "btnCancel";
            this.btnCancel.Size = new System.Drawing.Size(75, 23);
            this.btnCancel.TabIndex = 28;
            this.btnCancel.Text = "Cancel";
            this.btnCancel.UseVisualStyleBackColor = true;
            this.btnCancel.Click += new System.EventHandler(this.btnCancel_Click);
            // 
            // lblCountries
            // 
            this.lblCountries.AutoSize = true;
            this.lblCountries.Location = new System.Drawing.Point(13, 376);
            this.lblCountries.Name = "lblCountries";
            this.lblCountries.Size = new System.Drawing.Size(53, 13);
            this.lblCountries.TabIndex = 25;
            this.lblCountries.Text = "Countries";
            // 
            // lblErrors
            // 
            this.lblErrors.AutoSize = true;
            this.lblErrors.Location = new System.Drawing.Point(13, 229);
            this.lblErrors.Name = "lblErrors";
            this.lblErrors.Size = new System.Drawing.Size(74, 13);
            this.lblErrors.TabIndex = 23;
            this.lblErrors.Text = "Errors (if any)";
            // 
            // gdvCountries
            // 
            this.gdvCountries.AllowUserToAddRows = false;
            this.gdvCountries.AllowUserToDeleteRows = false;
            this.gdvCountries.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.gdvCountries.Location = new System.Drawing.Point(11, 392);
            this.gdvCountries.Name = "gdvCountries";
            this.gdvCountries.ReadOnly = true;
            this.gdvCountries.Size = new System.Drawing.Size(550, 127);
            this.gdvCountries.TabIndex = 26;
            // 
            // btnSubmit
            // 
            this.btnSubmit.Location = new System.Drawing.Point(406, 525);
            this.btnSubmit.Name = "btnSubmit";
            this.btnSubmit.Size = new System.Drawing.Size(75, 23);
            this.btnSubmit.TabIndex = 27;
            this.btnSubmit.Text = "Submit";
            this.btnSubmit.UseVisualStyleBackColor = true;
            this.btnSubmit.Click += new System.EventHandler(this.btnSubmit_Click);
            // 
            // lblAccountEntity
            // 
            this.lblAccountEntity.AutoSize = true;
            this.lblAccountEntity.Location = new System.Drawing.Point(6, 147);
            this.lblAccountEntity.Name = "lblAccountEntity";
            this.lblAccountEntity.Size = new System.Drawing.Size(63, 13);
            this.lblAccountEntity.TabIndex = 10;
            this.lblAccountEntity.Text = "Acc. Entity:";
            // 
            // gcClientInfo
            // 
            this.gcClientInfo.Controls.Add(this.lblVersion);
            this.gcClientInfo.Controls.Add(this.lblAccountEntity);
            this.gcClientInfo.Controls.Add(this.lblAccountCountry);
            this.gcClientInfo.Controls.Add(this.lblAccountPin);
            this.gcClientInfo.Controls.Add(this.lblAccountNumber);
            this.gcClientInfo.Controls.Add(this.lblPassword);
            this.gcClientInfo.Controls.Add(this.lblUsername);
            this.gcClientInfo.Controls.Add(this.txtVersion);
            this.gcClientInfo.Controls.Add(this.txtAccountEntity);
            this.gcClientInfo.Controls.Add(this.txtAccountCountryCode);
            this.gcClientInfo.Controls.Add(this.txtAccountPin);
            this.gcClientInfo.Controls.Add(this.txtAccountNumber);
            this.gcClientInfo.Controls.Add(this.txtPassword);
            this.gcClientInfo.Controls.Add(this.txtUsername);
            this.gcClientInfo.Location = new System.Drawing.Point(10, 17);
            this.gcClientInfo.Name = "gcClientInfo";
            this.gcClientInfo.Size = new System.Drawing.Size(552, 198);
            this.gcClientInfo.TabIndex = 29;
            this.gcClientInfo.TabStop = false;
            this.gcClientInfo.Text = "ClientInfo";
            // 
            // lblVersion
            // 
            this.lblVersion.AutoSize = true;
            this.lblVersion.Location = new System.Drawing.Point(6, 174);
            this.lblVersion.Name = "lblVersion";
            this.lblVersion.Size = new System.Drawing.Size(46, 13);
            this.lblVersion.TabIndex = 12;
            this.lblVersion.Text = "Version:";
            // 
            // lblAccountCountry
            // 
            this.lblAccountCountry.AutoSize = true;
            this.lblAccountCountry.Location = new System.Drawing.Point(6, 122);
            this.lblAccountCountry.Name = "lblAccountCountry";
            this.lblAccountCountry.Size = new System.Drawing.Size(74, 13);
            this.lblAccountCountry.TabIndex = 8;
            this.lblAccountCountry.Text = "Acc. Country:";
            // 
            // lblAccountPin
            // 
            this.lblAccountPin.AutoSize = true;
            this.lblAccountPin.Location = new System.Drawing.Point(6, 96);
            this.lblAccountPin.Name = "lblAccountPin";
            this.lblAccountPin.Size = new System.Drawing.Size(49, 13);
            this.lblAccountPin.TabIndex = 6;
            this.lblAccountPin.Text = "Acc. Pin:";
            // 
            // lblAccountNumber
            // 
            this.lblAccountNumber.AutoSize = true;
            this.lblAccountNumber.Location = new System.Drawing.Point(6, 70);
            this.lblAccountNumber.Name = "lblAccountNumber";
            this.lblAccountNumber.Size = new System.Drawing.Size(52, 13);
            this.lblAccountNumber.TabIndex = 4;
            this.lblAccountNumber.Text = "Acc. No.:";
            // 
            // lblPassword
            // 
            this.lblPassword.AutoSize = true;
            this.lblPassword.Location = new System.Drawing.Point(6, 43);
            this.lblPassword.Name = "lblPassword";
            this.lblPassword.Size = new System.Drawing.Size(57, 13);
            this.lblPassword.TabIndex = 2;
            this.lblPassword.Text = "Password:";
            // 
            // lblUsername
            // 
            this.lblUsername.AutoSize = true;
            this.lblUsername.Location = new System.Drawing.Point(6, 18);
            this.lblUsername.Name = "lblUsername";
            this.lblUsername.Size = new System.Drawing.Size(59, 13);
            this.lblUsername.TabIndex = 0;
            this.lblUsername.Text = "Username:";
            // 
            // txtVersion
            // 
            this.txtVersion.Location = new System.Drawing.Point(89, 170);
            this.txtVersion.Name = "txtVersion";
            this.txtVersion.Size = new System.Drawing.Size(167, 20);
            this.txtVersion.TabIndex = 13;
            this.txtVersion.Text = "1.0";
            // 
            // txtAccountEntity
            // 
            this.txtAccountEntity.Location = new System.Drawing.Point(89, 144);
            this.txtAccountEntity.Name = "txtAccountEntity";
            this.txtAccountEntity.Size = new System.Drawing.Size(167, 20);
            this.txtAccountEntity.TabIndex = 11;
            this.txtAccountEntity.Text = "AMM";
            // 
            // txtAccountCountryCode
            // 
            this.txtAccountCountryCode.Location = new System.Drawing.Point(89, 118);
            this.txtAccountCountryCode.Name = "txtAccountCountryCode";
            this.txtAccountCountryCode.Size = new System.Drawing.Size(167, 20);
            this.txtAccountCountryCode.TabIndex = 9;
            this.txtAccountCountryCode.Text = "JO";
            // 
            // txtAccountPin
            // 
            this.txtAccountPin.Location = new System.Drawing.Point(89, 92);
            this.txtAccountPin.Name = "txtAccountPin";
            this.txtAccountPin.Size = new System.Drawing.Size(167, 20);
            this.txtAccountPin.TabIndex = 7;
            this.txtAccountPin.Text = "221321";
            // 
            // txtAccountNumber
            // 
            this.txtAccountNumber.Location = new System.Drawing.Point(89, 66);
            this.txtAccountNumber.Name = "txtAccountNumber";
            this.txtAccountNumber.Size = new System.Drawing.Size(167, 20);
            this.txtAccountNumber.TabIndex = 5;
            this.txtAccountNumber.Text = "20016";
            // 
            // txtPassword
            // 
            this.txtPassword.Location = new System.Drawing.Point(89, 40);
            this.txtPassword.Name = "txtPassword";
            this.txtPassword.Size = new System.Drawing.Size(167, 20);
            this.txtPassword.TabIndex = 3;
            this.txtPassword.Text = "123456789";
            // 
            // txtUsername
            // 
            this.txtUsername.Location = new System.Drawing.Point(89, 14);
            this.txtUsername.Name = "txtUsername";
            this.txtUsername.Size = new System.Drawing.Size(167, 20);
            this.txtUsername.TabIndex = 1;
            this.txtUsername.Text = "reem@reem.com";
            // 
            // dgvErrors
            // 
            this.dgvErrors.AllowUserToAddRows = false;
            this.dgvErrors.AllowUserToDeleteRows = false;
            this.dgvErrors.ColumnHeadersHeightSizeMode = System.Windows.Forms.DataGridViewColumnHeadersHeightSizeMode.AutoSize;
            this.dgvErrors.Location = new System.Drawing.Point(11, 247);
            this.dgvErrors.Name = "dgvErrors";
            this.dgvErrors.ReadOnly = true;
            this.dgvErrors.Size = new System.Drawing.Size(550, 127);
            this.dgvErrors.TabIndex = 24;
            // 
            // frmFetchCountries
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(572, 564);
            this.Controls.Add(this.btnCancel);
            this.Controls.Add(this.lblCountries);
            this.Controls.Add(this.lblErrors);
            this.Controls.Add(this.gdvCountries);
            this.Controls.Add(this.btnSubmit);
            this.Controls.Add(this.gcClientInfo);
            this.Controls.Add(this.dgvErrors);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.MinimizeBox = false;
            this.Name = "frmFetchCountries";
            this.ShowInTaskbar = false;
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterParent;
            this.Text = "Fetch Countries";
            ((System.ComponentModel.ISupportInitialize)(this.gdvCountries)).EndInit();
            this.gcClientInfo.ResumeLayout(false);
            this.gcClientInfo.PerformLayout();
            ((System.ComponentModel.ISupportInitialize)(this.dgvErrors)).EndInit();
            this.ResumeLayout(false);
            this.PerformLayout();

        }

        #endregion

        internal System.Windows.Forms.Button btnCancel;
        internal System.Windows.Forms.Label lblCountries;
        internal System.Windows.Forms.Label lblErrors;
        internal System.Windows.Forms.DataGridView gdvCountries;
        internal System.Windows.Forms.Button btnSubmit;
        internal System.Windows.Forms.Label lblAccountEntity;
        internal System.Windows.Forms.GroupBox gcClientInfo;
        internal System.Windows.Forms.Label lblVersion;
        internal System.Windows.Forms.Label lblAccountCountry;
        internal System.Windows.Forms.Label lblAccountPin;
        internal System.Windows.Forms.Label lblAccountNumber;
        internal System.Windows.Forms.Label lblPassword;
        internal System.Windows.Forms.Label lblUsername;
        internal System.Windows.Forms.TextBox txtVersion;
        internal System.Windows.Forms.TextBox txtAccountEntity;
        internal System.Windows.Forms.TextBox txtAccountCountryCode;
        internal System.Windows.Forms.TextBox txtAccountPin;
        internal System.Windows.Forms.TextBox txtAccountNumber;
        internal System.Windows.Forms.TextBox txtPassword;
        internal System.Windows.Forms.TextBox txtUsername;
        internal System.Windows.Forms.DataGridView dgvErrors;
    }
}