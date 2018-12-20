namespace LocationAPIClientCSharp
{
    partial class frmMain
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
            this.tlpOptions = new System.Windows.Forms.TableLayoutPanel();
            this.btnFetchOffices = new System.Windows.Forms.Button();
            this.btnFetchCities = new System.Windows.Forms.Button();
            this.btnFetchCountry = new System.Windows.Forms.Button();
            this.btnFetchCountries = new System.Windows.Forms.Button();
            this.btnValidateAddress = new System.Windows.Forms.Button();
            this.lblFetchOffices = new System.Windows.Forms.Label();
            this.lblFetchCities = new System.Windows.Forms.Label();
            this.lblFetchCountry = new System.Windows.Forms.Label();
            this.lblFetchCountries = new System.Windows.Forms.Label();
            this.lblValidateAddress = new System.Windows.Forms.Label();
            this.btnExit = new System.Windows.Forms.Button();
            this.lblExit = new System.Windows.Forms.Label();
            this.tlpOptions.SuspendLayout();
            this.SuspendLayout();
            // 
            // tlpOptions
            // 
            this.tlpOptions.ColumnCount = 2;
            this.tlpOptions.ColumnStyles.Add(new System.Windows.Forms.ColumnStyle(System.Windows.Forms.SizeType.Percent, 21.6152F));
            this.tlpOptions.ColumnStyles.Add(new System.Windows.Forms.ColumnStyle(System.Windows.Forms.SizeType.Percent, 78.3848F));
            this.tlpOptions.Controls.Add(this.btnFetchOffices, 0, 4);
            this.tlpOptions.Controls.Add(this.btnFetchCities, 0, 3);
            this.tlpOptions.Controls.Add(this.btnFetchCountry, 0, 2);
            this.tlpOptions.Controls.Add(this.btnFetchCountries, 0, 1);
            this.tlpOptions.Controls.Add(this.btnValidateAddress, 0, 0);
            this.tlpOptions.Controls.Add(this.lblFetchOffices, 1, 4);
            this.tlpOptions.Controls.Add(this.lblFetchCities, 1, 3);
            this.tlpOptions.Controls.Add(this.lblFetchCountry, 1, 2);
            this.tlpOptions.Controls.Add(this.lblFetchCountries, 1, 1);
            this.tlpOptions.Controls.Add(this.lblValidateAddress, 1, 0);
            this.tlpOptions.Controls.Add(this.btnExit, 0, 5);
            this.tlpOptions.Controls.Add(this.lblExit, 1, 5);
            this.tlpOptions.Dock = System.Windows.Forms.DockStyle.Fill;
            this.tlpOptions.Location = new System.Drawing.Point(0, 0);
            this.tlpOptions.Name = "tlpOptions";
            this.tlpOptions.RowCount = 6;
            this.tlpOptions.RowStyles.Add(new System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667F));
            this.tlpOptions.RowStyles.Add(new System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667F));
            this.tlpOptions.RowStyles.Add(new System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667F));
            this.tlpOptions.RowStyles.Add(new System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667F));
            this.tlpOptions.RowStyles.Add(new System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667F));
            this.tlpOptions.RowStyles.Add(new System.Windows.Forms.RowStyle(System.Windows.Forms.SizeType.Percent, 16.66667F));
            this.tlpOptions.Size = new System.Drawing.Size(421, 352);
            this.tlpOptions.TabIndex = 1;
            // 
            // btnFetchOffices
            // 
            this.btnFetchOffices.Dock = System.Windows.Forms.DockStyle.Fill;
            this.btnFetchOffices.Image = global::LocationAPIClientCSharp.Properties.Resources._1392243247_companies;
            this.btnFetchOffices.Location = new System.Drawing.Point(3, 235);
            this.btnFetchOffices.Name = "btnFetchOffices";
            this.btnFetchOffices.Size = new System.Drawing.Size(84, 52);
            this.btnFetchOffices.TabIndex = 8;
            this.btnFetchOffices.UseVisualStyleBackColor = true;
            this.btnFetchOffices.Click += new System.EventHandler(this.btnFetchOffices_Click);
            // 
            // btnFetchCities
            // 
            this.btnFetchCities.Dock = System.Windows.Forms.DockStyle.Fill;
            this.btnFetchCities.Image = global::LocationAPIClientCSharp.Properties.Resources._1392243185_Home;
            this.btnFetchCities.Location = new System.Drawing.Point(3, 177);
            this.btnFetchCities.Name = "btnFetchCities";
            this.btnFetchCities.Size = new System.Drawing.Size(84, 52);
            this.btnFetchCities.TabIndex = 6;
            this.btnFetchCities.UseVisualStyleBackColor = true;
            this.btnFetchCities.Click += new System.EventHandler(this.btnFetchCities_Click);
            // 
            // btnFetchCountry
            // 
            this.btnFetchCountry.Dock = System.Windows.Forms.DockStyle.Fill;
            this.btnFetchCountry.Image = global::LocationAPIClientCSharp.Properties.Resources._1392243212_companies;
            this.btnFetchCountry.Location = new System.Drawing.Point(3, 119);
            this.btnFetchCountry.Name = "btnFetchCountry";
            this.btnFetchCountry.Size = new System.Drawing.Size(84, 52);
            this.btnFetchCountry.TabIndex = 4;
            this.btnFetchCountry.UseVisualStyleBackColor = true;
            this.btnFetchCountry.Click += new System.EventHandler(this.btnFetchCountry_Click);
            // 
            // btnFetchCountries
            // 
            this.btnFetchCountries.Dock = System.Windows.Forms.DockStyle.Fill;
            this.btnFetchCountries.Image = global::LocationAPIClientCSharp.Properties.Resources._1392243137_buildings;
            this.btnFetchCountries.Location = new System.Drawing.Point(3, 61);
            this.btnFetchCountries.Name = "btnFetchCountries";
            this.btnFetchCountries.Size = new System.Drawing.Size(84, 52);
            this.btnFetchCountries.TabIndex = 2;
            this.btnFetchCountries.UseVisualStyleBackColor = true;
            this.btnFetchCountries.Click += new System.EventHandler(this.btnFetchCountries_Click);
            // 
            // btnValidateAddress
            // 
            this.btnValidateAddress.Dock = System.Windows.Forms.DockStyle.Fill;
            this.btnValidateAddress.Image = global::LocationAPIClientCSharp.Properties.Resources._1392243130_edit_validated;
            this.btnValidateAddress.Location = new System.Drawing.Point(3, 3);
            this.btnValidateAddress.Name = "btnValidateAddress";
            this.btnValidateAddress.Size = new System.Drawing.Size(84, 52);
            this.btnValidateAddress.TabIndex = 0;
            this.btnValidateAddress.UseVisualStyleBackColor = true;
            this.btnValidateAddress.Click += new System.EventHandler(this.btnValidateAddress_Click);
            // 
            // lblFetchOffices
            // 
            this.lblFetchOffices.AutoSize = true;
            this.lblFetchOffices.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblFetchOffices.Font = new System.Drawing.Font("Tahoma", 15F);
            this.lblFetchOffices.Location = new System.Drawing.Point(93, 232);
            this.lblFetchOffices.Name = "lblFetchOffices";
            this.lblFetchOffices.Size = new System.Drawing.Size(325, 58);
            this.lblFetchOffices.TabIndex = 9;
            this.lblFetchOffices.Text = "Fetch Offices";
            this.lblFetchOffices.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // lblFetchCities
            // 
            this.lblFetchCities.AutoSize = true;
            this.lblFetchCities.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblFetchCities.Font = new System.Drawing.Font("Tahoma", 15F);
            this.lblFetchCities.Location = new System.Drawing.Point(93, 174);
            this.lblFetchCities.Name = "lblFetchCities";
            this.lblFetchCities.Size = new System.Drawing.Size(325, 58);
            this.lblFetchCities.TabIndex = 7;
            this.lblFetchCities.Text = "Fetch Cities";
            this.lblFetchCities.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // lblFetchCountry
            // 
            this.lblFetchCountry.AutoSize = true;
            this.lblFetchCountry.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblFetchCountry.Font = new System.Drawing.Font("Tahoma", 15F);
            this.lblFetchCountry.Location = new System.Drawing.Point(93, 116);
            this.lblFetchCountry.Name = "lblFetchCountry";
            this.lblFetchCountry.Size = new System.Drawing.Size(325, 58);
            this.lblFetchCountry.TabIndex = 5;
            this.lblFetchCountry.Text = "Fetch Country";
            this.lblFetchCountry.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // lblFetchCountries
            // 
            this.lblFetchCountries.AutoSize = true;
            this.lblFetchCountries.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblFetchCountries.Font = new System.Drawing.Font("Tahoma", 15F);
            this.lblFetchCountries.Location = new System.Drawing.Point(93, 58);
            this.lblFetchCountries.Name = "lblFetchCountries";
            this.lblFetchCountries.Size = new System.Drawing.Size(325, 58);
            this.lblFetchCountries.TabIndex = 3;
            this.lblFetchCountries.Text = "Fetch Countries";
            this.lblFetchCountries.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // lblValidateAddress
            // 
            this.lblValidateAddress.AutoSize = true;
            this.lblValidateAddress.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblValidateAddress.Font = new System.Drawing.Font("Tahoma", 15F);
            this.lblValidateAddress.Location = new System.Drawing.Point(93, 0);
            this.lblValidateAddress.Name = "lblValidateAddress";
            this.lblValidateAddress.Size = new System.Drawing.Size(325, 58);
            this.lblValidateAddress.TabIndex = 1;
            this.lblValidateAddress.Text = "Validate Address";
            this.lblValidateAddress.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // btnExit
            // 
            this.btnExit.DialogResult = System.Windows.Forms.DialogResult.Cancel;
            this.btnExit.Dock = System.Windows.Forms.DockStyle.Fill;
            this.btnExit.Image = global::LocationAPIClientCSharp.Properties.Resources._1392243510_exit;
            this.btnExit.Location = new System.Drawing.Point(3, 293);
            this.btnExit.Name = "btnExit";
            this.btnExit.Size = new System.Drawing.Size(84, 56);
            this.btnExit.TabIndex = 10;
            this.btnExit.UseVisualStyleBackColor = true;
            this.btnExit.Click += new System.EventHandler(this.btnExit_Click);
            // 
            // lblExit
            // 
            this.lblExit.AutoSize = true;
            this.lblExit.Dock = System.Windows.Forms.DockStyle.Fill;
            this.lblExit.Font = new System.Drawing.Font("Tahoma", 15F);
            this.lblExit.Location = new System.Drawing.Point(93, 290);
            this.lblExit.Name = "lblExit";
            this.lblExit.Size = new System.Drawing.Size(325, 62);
            this.lblExit.TabIndex = 11;
            this.lblExit.Text = "Exit";
            this.lblExit.TextAlign = System.Drawing.ContentAlignment.MiddleLeft;
            // 
            // frmMain
            // 
            this.AutoScaleDimensions = new System.Drawing.SizeF(6F, 13F);
            this.AutoScaleMode = System.Windows.Forms.AutoScaleMode.Font;
            this.ClientSize = new System.Drawing.Size(421, 352);
            this.Controls.Add(this.tlpOptions);
            this.FormBorderStyle = System.Windows.Forms.FormBorderStyle.FixedSingle;
            this.MaximizeBox = false;
            this.Name = "frmMain";
            this.StartPosition = System.Windows.Forms.FormStartPosition.CenterScreen;
            this.Text = "Location API";
            this.tlpOptions.ResumeLayout(false);
            this.tlpOptions.PerformLayout();
            this.ResumeLayout(false);

        }

        #endregion

        internal System.Windows.Forms.TableLayoutPanel tlpOptions;
        internal System.Windows.Forms.Button btnFetchOffices;
        internal System.Windows.Forms.Button btnFetchCities;
        internal System.Windows.Forms.Button btnFetchCountry;
        internal System.Windows.Forms.Button btnFetchCountries;
        internal System.Windows.Forms.Button btnValidateAddress;
        internal System.Windows.Forms.Label lblFetchOffices;
        internal System.Windows.Forms.Label lblFetchCities;
        internal System.Windows.Forms.Label lblFetchCountry;
        internal System.Windows.Forms.Label lblFetchCountries;
        internal System.Windows.Forms.Label lblValidateAddress;
        internal System.Windows.Forms.Button btnExit;
        internal System.Windows.Forms.Label lblExit;
    }
}