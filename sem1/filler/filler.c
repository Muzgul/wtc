#include <stdio.h>
#include <unistd.h>
#include "libft/libft.h"

int read_info(char ***grid, char ***piece);
int valid_placement(char **grid, char **piece, int y, int x);
void read_grid(char ***grid);
void read_piece(char ***piece);
int make_move(char **grid, char **piece);

int main()
{
	char *line;
	char **grid;
	char **piece;

	//Skip all initial content
	get_next_line(0, &line);
	while (ft_strncmp(line, "$$$", 3) != 0)
		get_next_line(0, &line);

	//Execute Filler
	while (1 == 1)
	{
		read_grid(&grid);
		read_piece(&piece);
		if (make_move(grid, piece) == 0)
			ft_putchar('\n');
	}
	return (2);
}

int make_move(char **grid, char **piece)
{
	int breaker = 0;
	int x, y;	

	//Loop to find first possible placement (from top left)
	breaker = 0;
	y = 0;
	while (grid[y] != NULL && breaker == 0)
	{
		x = 0;
		while (grid[y][x] != '\0' && breaker == 0)
		{
			if (valid_placement(grid, piece, y, x) == 1 && breaker == 0)
				{
					//printf("%i %i\n", y, x);
					ft_putnbr(y);
					ft_putchar(' ');
					ft_putnbr(x);
					ft_putchar('\n');
					breaker++;
				}
			x++;
		}
		y++;
	}
	return (breaker);
}

int valid_placement(char **grid, char **piece, int y, int x)
{
	int m;
	int n;
	int grid_r;
	int grid_c;
	int overlap;

	overlap = 0;
	grid_r = 0;
	while (grid[grid_r] != NULL)
		grid_r++;
	grid_c = 0;
	while (grid[0][grid_c] != '\0')
		grid_c++;
	m = 0;
	while (piece[m] != NULL)
	{
		n = 0;
		while (piece[m][n] != '\0')
		{
			if (piece[m][n] == '*')
			{
				if (!(((n + x) >= 0 && (n + x) < grid_c) && ((m + y) >= 0 && (m + y) < grid_r)))
					return (-1);
				if (grid[m + y][n + x] == 'X' || grid[m + y][n + x] == 'x')
					return (-1);
				if (grid[m + y][n + x] == 'O' || grid[m + y][n + x] == 'o')
					overlap++;
			}
			n++;
		}
		m++;
	}
	return (overlap);
}

void	 read_grid(char ***grid)
{
	char *line;
	char **t_grid;
	char **split;
	int grid_row;
	int temp_int;
	int ret;

	//Get Plateau line
	ret = get_next_line(0, &line);
	if (ft_strncmp(line, "Plateau", 7) == 0)
	{
		//split to get grid info
		split = ft_strsplit(line, ' ');
		//read header line ie 1234567890123
		ret = get_next_line(0, &line);
		grid_row = ft_atoi(split[1]);
		t_grid = (char **)malloc(sizeof(char *) * grid_row + 1);
		temp_int = 0;
		//read up to num_rows
		while (temp_int < grid_row && (ret = get_next_line(0, &line)) > 0)
		{
			t_grid[temp_int] = ft_strdup(&line[4]);
			temp_int++;
		}
		t_grid[temp_int] = NULL;
		*grid = t_grid;
    }
    
}

void 	read_piece(char ***piece)
{
	char *line;
	char **t_piece;
	char **split;
	int piece_row;
	int temp_int;
	int ret;

	ret = get_next_line(0, &line);
	if (ft_strncmp(line, "Piece", 5) == 0)
	{
		//split to get grid info
		split = ft_strsplit(line, ' ');
		piece_row = ft_atoi(split[1]);
		t_piece = (char **)malloc(sizeof(char *) * piece_row + 1);
		temp_int = 0;
		//read up untill num_rows
		while (temp_int < piece_row && (ret = get_next_line(0, &line)) > 0)
		{
			t_piece[temp_int] = ft_strdup(line);
			temp_int++;
		}
		t_piece[temp_int] = NULL;
		*piece = t_piece;
	}
	
}