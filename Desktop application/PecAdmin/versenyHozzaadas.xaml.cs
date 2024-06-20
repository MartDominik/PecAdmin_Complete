using MySql.Data.MySqlClient;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Remoting.Contexts;
using System.Text;
using System.Threading.Tasks;
using System.Windows;
using System.Windows.Controls;
using System.Windows.Data;
using System.Windows.Documents;
using System.Windows.Input;
using System.Windows.Media;
using System.Windows.Media.Imaging;
using System.Windows.Shapes;
using MySql.Data.MySqlClient;
using System.IO;

namespace PecAdmin
{
    /// <summary>
    /// Interaction logic for versenyHozzaadas.xaml
    /// </summary>
    public partial class versenyHozzaadas : Window
    {
        static string connectionString = "server=localhost;database=md_pecadmin;username=root;port=3306;password=";
        MySqlConnection connect = new MySqlConnection(connectionString);
        string nev = string.Empty;
        string datum = string.Empty;

        public versenyHozzaadas()
        {
            InitializeComponent();
          
            string select = $"SELECT helyszineks.nev FROM `helyszineks`";
            connect.Open();
            MySqlCommand Select_cmd = new MySqlCommand(select, connect);
            MySqlDataReader Reader = Select_cmd.ExecuteReader();
            while (Reader.Read())
            {
                helyszin.Items.Add(Reader[0]);
            }
            connect.Close();

        }
        private void CloseButton_Click(object sender, RoutedEventArgs e)
        {
            Close();
        }
        private void MaxButton_Click(object sender, RoutedEventArgs e)
        {
            if (WindowState == WindowState.Normal)
            {
                WindowState = WindowState.Maximized;
            }
            else
            {
                WindowState = WindowState.Normal;
            }
        }
        private void MinButton_Click(object sender, RoutedEventArgs e)
        {
            WindowState = WindowState.Minimized;
        }

        private void topBar_MouseDown(object sender, MouseButtonEventArgs e)
        {
            if (e.ChangedButton == MouseButton.Left)
                this.DragMove();
        }

        private void Hozzaadas(object sender, RoutedEventArgs e)
        {

            if (versenynev.Text != string.Empty)
            {
                try
                {
                    nev = versenynev.Text.ToString().Replace(' ', '_');
                    datum = datumvalasztas.Text.ToString().Replace('.', '-').Replace(" ","");
                    string table = $"INSERT INTO `manualversenyek`(`versenynev`, `helyszinid`, `idopont`) VALUES ('{nev}', (SELECT helyszineks.id FROM helyszineks WHERE helyszineks.nev = '{helyszin.Text}'),'{datum}');";
                    MySqlCommand Create_table = new MySqlCommand(table, connect);
                    connect.Open();
                    Create_table.ExecuteNonQuery();
                    connect.Close();

                    MessageBox.Show("Sikeres Létrehozás!");

                    this.Close();

                }
                catch (MySqlException)
                {
                    connect.Close();
                    MessageBox.Show("Már Létezik ilyen verseny, kérlek adj más nevet!");
                }

            }
            else
            {
                MessageBox.Show("Töltse ki a név mezőt!");
            }

           

        }

    
    }
}
