using System;
using System.Windows.Forms;
using HWIDGrabber;

namespace Ayy_Hook
{
    public partial class Form1 : MetroFramework.Forms.MetroForm
    {
        string hwid;

        public Form1()
        {
            InitializeComponent();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            timer1.Start();
            hwid = HWDI.GetMachineGuid();

            if (Properties.Settings.Default.Checked == true)
            {
                metroTextBox1.Text = Properties.Settings.Default.Username;
                metroTextBox2.Text = Properties.Settings.Default.Password;
                metroCheckBox1.Checked = Properties.Settings.Default.Checked;
            }
        }

        private void button1_Click(object sender, EventArgs e)
        {
            this.Hide();//Closes Form1 in order to open Form2
            var form2 = new Form2();
            form2.Closed += (f, args) => this.Close();
            form2.Show();//
        }

        private void metroButton1_Click(object sender, EventArgs e)
        {

            Properties.Settings.Default.Username = metroTextBox1.Text;
            Properties.Settings.Default.Password = metroTextBox2.Text;
            Properties.Settings.Default.Checked = metroCheckBox1.Checked;
            Properties.Settings.Default.Save();

            webBrowser1.Navigate("https://google.com/check.php?username=" + metroTextBox1.Text + "&password=" + metroTextBox2.Text + "&hwid=" + hwid);
        }
        private void webBrowser1_DocumentCompleted(object sender, WebBrowserDocumentCompletedEventArgs e)
        {
            if (webBrowser1.DocumentText.Contains("p1"))
            {
                if (webBrowser1.DocumentText.Contains("g4") || webBrowser1.DocumentText.Contains("g6") || webBrowser1.DocumentText.Contains("g8"))
                {
                    if (webBrowser1.DocumentText.Contains("h1"))
                    {
                        var form3 = new Form3();
                        form3.Closed += (s, args) => this.Close();
                        form3.Show();
                        this.Hide();
                    }
                    else if (webBrowser1.DocumentText.Contains("h2"))
                    {
                        MessageBox.Show("Error : Incorrect HWID.", "Error");
                    }
                    else if (webBrowser1.DocumentText.Contains("h3"))
                    {
                        MessageBox.Show("Note : setting new HWID.", "HWID Reset");
                    }
                }
                else
                {
                    MessageBox.Show("Error : Incorrect group.", "Error");
                }
            }
            else
            {
                MessageBox.Show("Error : Incorrect username or password.", "Error");
            }
        }
    }
}
